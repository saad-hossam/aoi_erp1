<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('name');

        $roles = Role::with('permissions')
            ->when($search, fn ($q) => $q->where('name', 'like', '%'.$search.'%'))
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.roles.index', compact('roles', 'search'));
    }

    public function create()
    {
        return view('dashboard.roles.create', [
            'role'        => new Role,
            'permissions' => Permission::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => ['required', 'string', 'max:255', Rule::unique('roles', 'name')],
            'permissions'   => ['nullable', 'array'],
            'permissions.*' => ['integer', Rule::exists('permissions', 'id')],
        ]);

        $role = Role::create(['name' => $data['name'], 'guard_name' => 'web']);
        $role->syncPermissions(array_map('intval', $data['permissions'] ?? []));

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        return view('dashboard.roles.edit', [
            'role'        => $role->load('permissions'),
            'permissions' => Permission::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name'          => ['required', 'string', 'max:255', Rule::unique('roles', 'name')->ignore($role->id)],
            'permissions'   => ['nullable', 'array'],
            'permissions.*' => ['integer', Rule::exists('permissions', 'id')],
        ]);

        $role->update(['name' => $data['name']]);
        $role->syncPermissions(array_map('intval', $data['permissions'] ?? []));

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();   // Spatie also removes its links to permissions and employees

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
