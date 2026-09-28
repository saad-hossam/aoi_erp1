<?php

namespace App\Http\Controllers;

use App\Models\Emp;
use App\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * CRUD on the Oracle EMP table + assigning roles to each employee.
 */
class EmpController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $emps = Emp::with('roles')
            ->search($search)
            ->orderBy('USER_NAME')
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.emps.index', compact('emps', 'search'));
    }

    public function create()
    {
        return view('dashboard.emps.create', $this->formData(new Emp));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $roleIds = $data['roles'];
        unset($data['roles']);

        DB::connection('oracle')->transaction(function () use ($data, $roleIds) {
            // EMP_NO has no sequence: use the number typed in, otherwise MAX + 1.
            $data['EMP_NO'] = $data['EMP_NO'] ?? ((int) Emp::max('EMP_NO') + 1);

            $emp = Emp::create($data);
            $emp->syncRoles($roleIds);
        });

        return redirect()->route('emps.index')->with('success', 'Employee created successfully.');
    }

    public function edit(Emp $emp)
    {
        return view('dashboard.emps.edit', $this->formData($emp));
    }

    public function update(Request $request, Emp $emp)
    {
        $data = $this->validated($request, $emp);
        $roleIds = $data['roles'];
        unset($data['roles'], $data['EMP_NO']);

        if (blank($data['PASS_WORD'] ?? null)) {
            unset($data['PASS_WORD']);          // leave the password as it is
        }

        DB::connection('oracle')->transaction(function () use ($emp, $data, $roleIds) {
            $emp->update($data);
            $emp->syncRoles($roleIds);
        });

        return redirect()->route('emps.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Emp $emp)
    {
        if ($emp->is(Auth::user())) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        try {
            DB::connection('oracle')->transaction(fn () => $emp->delete());   // Spatie also detaches the roles
        } catch (QueryException $e) {
            return back()->with('error', 'This employee is referenced by other records and cannot be deleted.');
        }

        return redirect()->route('emps.index')->with('success', 'Employee deleted successfully.');
    }

    /* ------------------------------------------------------------------ */

    protected function formData(Emp $emp): array
    {
        try {
            $units = DB::connection('oracle')->table('UNITS')
                ->select('UNIT_CODE', 'UNIT_NAME')
                ->whereNotNull('UNIT_CODE')
                ->orderBy('UNIT_NAME')
                ->get()
                ->map(fn ($u) => (object) array_change_key_case((array) $u, CASE_UPPER));
        } catch (\Throwable $e) {
            $units = collect();
        }

        return [
            'emp'             => $emp,
            'roles'           => Role::orderBy('name')->get(),
            'units'           => $units,
            'selectedRoleIds' => $emp->exists ? $emp->roles->pluck('id')->all() : [],
        ];
    }

    protected function validated(Request $request, ?Emp $emp = null): array
    {
        $number = ['nullable', 'integer', 'min:0'];

        $validator = Validator::make($request->all(), [
            'EMP_NO'     => $emp ? [] : ['nullable', 'integer', 'min:1', 'max:9999999999', Rule::unique('oracle.EMP', 'EMP_NO')],
            'USER_NAME'  => ['required', 'string', 'max:255'],
            'EMP_NAME'   => ['nullable', 'string', 'max:256'],
            'PASS_WORD'  => [$emp ? 'nullable' : 'required', 'string', 'max:50'],
            'EMP_STATUS' => ['required', 'integer'],
            'DEPT_CODE'  => $number,
            'FILE_NO'    => $number,
            'SIGN_TYPE'  => $number,
            'REAL_DEPT'  => $number,
            'MGR'        => $number,
            'ADMIN'      => ['nullable', 'boolean'],
            'roles'      => ['nullable', 'array'],
'roles.*' => ['integer', Rule::exists('oracle.roles', 'id')],        ]);

        $validator->after(function ($v) use ($request, $emp) {
            // UNIQUE (FILE_NO, EMP_STATUS, DEPT_CODE) on the EMP table
            $keys = $request->only(['FILE_NO', 'EMP_STATUS', 'DEPT_CODE']);
            if (count(array_filter($keys, fn ($x) => $x !== null && $x !== '')) === 3) {
                $q = Emp::query();
                foreach ($keys as $col => $val) {
                    $q->where($col, $val);
                }
                if ($emp) {
                    $q->where('EMP_NO', '!=', $emp->EMP_NO);
                }
                if ($q->exists()) {
                    $v->errors()->add('FILE_NO', 'Another employee already has this File No. in the same unit and department.');
                }
            }

            // do not let an admin lock himself out
            if ($emp && $emp->is(Auth::user()) && ! $v->errors()->any()) {
                $adminRole = Role::where('name', 'admin')->value('id');
                $stillAdmin = $request->boolean('ADMIN') || ($adminRole && in_array($adminRole, (array) $request->input('roles', [])));
                if (! $stillAdmin) {
                    $v->errors()->add('ADMIN', 'You cannot remove your own admin access.');
                }
            }
        });

        $data = $validator->validate();

        $data['ADMIN'] = $request->boolean('ADMIN') ? 1 : 0;
        $data['MGR']   = $data['MGR'] ?? 0;
        $data['roles'] = array_map('intval', $data['roles'] ?? []);
        $data['EMP_NO'] = isset($data['EMP_NO']) ? (int) $data['EMP_NO'] : null;

        return $data;
    }
}
