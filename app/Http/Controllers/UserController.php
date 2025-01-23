<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {


        return Inertia::render('Admin/Users/Index');
    }
    public function new()
    {
        $role = Role::where('name', 'ساده')->count();
        if (!$role) {
            $defaultRole = new Role;
            $defaultRole->name = 'ساده';
            $defaultRole->over_payment = 0;
            $defaultRole->save();
        }
        return Inertia::render('Admin/Users/New');
    }
    public function newStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:64',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = 1;
        $user->save();
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
    public function admins()
    {
        $admins = User::where('is_admin', 1)->get();
        $users = User::where('is_admin', 0)->get()->toArray();
        $context = [
            'admins' => $admins,
            'users' => $users
        ];
        return Inertia::render('Admin/Users/Admins', compact('context'));
    }
    public function roles()
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
    public function listDelete($id)
    {
        User::where('id', $id)->delete();
        return redirect(route('admin.users.list'));
    }

    public function listUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:64',
            'role_id' => "required"
        ]);
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->save();
        return redirect(route('admin.users.list'));
    }
    public function adminsDelete($id)
    {
        $admin = User::find($id);
        $admin->is_admin = 0;
        $admin->save();
        return redirect(route('admin.users.admins'));
    }
    public function adminsNew(Request $request)
    {
        $user = User::find($request->user_id);
        $user->is_admin = true;
        $user->save();
        return redirect(route('admin.users.admins'));
    }

    public function rolesDelete($id)
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
    public function rolesUpdate(Request $request)
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

    public function rolesStore(Request $request)
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

