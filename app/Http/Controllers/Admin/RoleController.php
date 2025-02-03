<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Http\Requests\Role\UpdateRequest;
use App\Http\Requests\Role\StoreRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class RoleController extends Controller
{
    public function list(): InertiaResponse
    {
        $roles = Role::all();
        $context = [
            'roles' => $roles,
        ];
        return Inertia::render('Admin/Users/Roles', compact('context'));
    }
    public function delete($id): RedirectResponse
    {
        if ($id == 1) {
            return redirect()->route('admin.users.roles');
        }
        $users = User::where('role_id', $id)->get();
        foreach ($users as $user) {
            $user->role_id = 1;
            User::updateUser($user);
        }
        Role::deleteRole($id);
        return redirect()->route('admin.users.roles');
    }
    public function update(UpdateRequest $request): RedirectResponse
    {
        $role = Role::find($request->id);
        $role->name = $request->name;
        $role->over_payment = $request->over_payment;
        Role::updateRole($role);
        return redirect()->route('admin.users.roles');
    }
    public function store(StoreRequest $request): RedirectResponse
    {
        Role::createRole($request->name,$request->over_payment);
        return redirect()->route('admin.users.roles');
    }

}
