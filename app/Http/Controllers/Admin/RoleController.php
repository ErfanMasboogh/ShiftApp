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
        $role = Role::where('name', 'ساده')->count();
        if (!$role) {
            $defaultRole = new Role;
            $defaultRole->name = 'ساده';
            $defaultRole->over_payment = 0;
            $defaultRole->save();
        }


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
            $user->save();
        }

        Role::find($id)->delete();
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
        $role->save();
        return redirect(route('admin.users.roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:32',
            'over_payment' => 'required|max:4'
        ]);

        $role = new Role;
        $role->name = $request->name;
        $role->over_payment = $request->over_payment;
        $role->save();
        return redirect(route('admin.users.roles'));
    }

}
