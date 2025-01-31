<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class UserController extends Controller
{
    public function new()
    {
        return Inertia::render('Admin/Users/New');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:64',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        User::createUser($request->name,$request->email , $request->password);
        return redirect(route('admin.users.list'));
    }
    public function list()
    {
        $role = Role::where('name', 'ساده')->count();
        if (!$role) {
            $defaultRole = new Role;
            $defaultRole->name = 'ساده';
            $defaultRole->over_payment = 0;
            $defaultRole->save();
        }
        $users = User::all()->toArray();
        $roles = Role::all()->toArray();
        $context = [
            'users' => $users,
            'roles' => $roles,
        ];
        return Inertia::render('Admin/Users/List', compact('context'));
    }
    public function delete($id)
    {
        User::deleteUser($id);
        return redirect(route('admin.users.list'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:64',
            'role_id' => "required"
        ]);
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        User::updateUser($user);
        return redirect(route('admin.users.list'));
    }
}

