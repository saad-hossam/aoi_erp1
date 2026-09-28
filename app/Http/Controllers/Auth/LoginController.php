<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Emp;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Unit -> Employee -> Password login, checked directly against Oracle EMP.
 * The logged-in user IS the EMP row (App\Models\Emp) – there is no shadow
 * `users` row any more, so roles assigned to the employee are the ones used.
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    // UNITS table: list of units shown in the first dropdown.
    protected string $unitsTable = 'UNITS';
    protected string $unitsCodeColumn = 'UNIT_CODE';
    protected string $unitsNameColumn = 'UNIT_NAME';

    public function showLoginForm()
    {
        $units = DB::connection('oracle')
            ->table($this->unitsTable)
            ->select($this->unitsCodeColumn, $this->unitsNameColumn)
            ->whereNotNull($this->unitsCodeColumn)
            ->whereNotNull($this->unitsNameColumn)
            ->orderBy($this->unitsNameColumn)
            ->get()
            ->map(fn ($u) => (object) array_change_key_case((array) $u, CASE_UPPER));

        return view('auth.login', compact('units'));
    }

    /** Employees of the selected unit (AJAX for the cascading dropdown). */
    public function getEmployeesByUnit(Request $request)
    {
        $employees = Emp::query()
            ->where('EMP_STATUS', $request->input('unit_code'))
            ->whereNotNull('USER_NAME')
            ->orderBy('USER_NAME')
            ->get(['EMP_NO', 'USER_NAME'])
            ->map(fn (Emp $e) => [
                'emp_code' => (string) $e->EMP_NO,
                'emp_name' => trim((string) $e->USER_NAME),
            ]);

        return response()->json($employees);
    }

    public function login(Request $request)
    {
        // The unit dropdown is still called "email" in the form.
        $request->validate([
            'email'    => 'required',
            'employee' => 'required|numeric',
            'password' => 'required',
        ], [], [
            'email'    => 'الوحدة',
            'employee' => 'الموظف',
            'password' => 'كلمة المرور',
        ]);

        $emp = Emp::query()
            ->where('EMP_NO', $request->input('employee'))
            ->where('EMP_STATUS', $request->input('email'))
            ->first();

        if (! $emp || ! $this->passwordMatches($request->input('password'), $emp->getAuthPassword())) {
            return back()
                ->withInput($request->only('email', 'employee'))
                ->withErrors(['password' => 'بيانات الدخول غير صحيحة.']);
        }

        Auth::login($emp, false);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    /**
     * EMP.PASS_WORD is compared as stored (plain text, as the existing ERP does).
     * If you later hash the column, replace this with Hash::check($input, $stored).
     */
    protected function passwordMatches(?string $input, $stored): bool
    {
        if ($stored === null || $input === null) {
            return false;
        }

        return hash_equals((string) $stored, (string) $input);
    }
}
