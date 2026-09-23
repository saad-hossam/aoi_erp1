<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

   $users = User::with('roles')->when($search, fn($q) => $q->where(...))->paginate(10);
    return view('dashboard.users.index', compact('users', 'search'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('dashboard.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'roles'    => 'array'
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->roles()->sync($request->roles);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

   // Show form to assign roles to a user
public function edit($userId)
{
    $user = User::with('roles')->findOrFail($userId);
    $roles = Role::orderBy('name','ASC')->get();

    return view('dashboard.users.edit', compact('user', 'roles'));
}

// Update roles for user
public function update(Request $request, $userId)
{
    $user = User::findOrFail($userId);
    $user->roles()->sync($request->roles ?? []); // يفرغ القديم ويخزن الجديد

    return redirect()->route('users.index')->with('success','Roles updated successfully.');
}


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
