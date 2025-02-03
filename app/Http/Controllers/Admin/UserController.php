<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use App\Http\Requests\User\StoreRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class UserController extends Controller
{
    public function new():InertiaResponse
    {
        return Inertia::render('Admin/Users/New');
    }
    public function store(StoreRequest $request):RedirectResponse
    {
        User::createUser($request->name,$request->email , $request->password);
        return redirect()->route('admin.users.list');
    }
    public function list(): InertiaResponse
    {
        $users = User::all()->toArray();
        $roles = Role::all()->toArray();
        $context = [
            'users' => $users,
            'roles' => $roles,
        ];
        return Inertia::render('Admin/Users/List', compact('context'));
    }
    public function delete($id):RedirectResponse
    {
        User::deleteUser($id);
        return redirect()->route('admin.users.list');
    }

    public function update(UpdateRequest $request): RedirectResponse
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        User::updateUser($user);
        return redirect()->route('admin.users.list');
    }
}

