<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function list()
    {
        $roles = Role::all();
        $context = [
            'roles' => $roles,
        ];
        return Inertia::render('Admin/Users/Roles', compact('context'));
    }
    public function delete($id)
    {
        if ($id == 1) {
            return redirect(route('admin.users.roles'));
        }
        $users = User::where('role_id', $id)->get();
        foreach ($users as $user) {
            $user->role_id = 1;
            User::updateUser($user);
        }
        Role::deleteRole($id);
        return redirect(route('admin.users.roles'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:64',
            'over_payment' => 'required|max:4'
        ]);
        $role = Role::find($request->id);
        $role->name = $request->name;
        $role->over_payment = $request->over_payment;
        Role::updateRole($role);
        return redirect(route('admin.users.roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:32',
            'over_payment' => 'required|max:4'
        ]);
        Role::createRole($request->name,$request->over_payment);
        return redirect(route('admin.users.roles'));
    }

}
