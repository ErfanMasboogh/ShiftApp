<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function list()
    {
        $admins = User::where('is_admin', 1)->get();
        $users = User::where('is_admin', 0)->get()->toArray();
        $context = [
            'admins' => $admins,
            'users' => $users
        ];
        return Inertia::render('Admin/Users/Admins', compact('context'));
    }
    public function delete($id)
    {
        $admin = User::find($id);
        $admin->is_admin = 0;
        User::updateUser($admin);
        return redirect(route('admin.users.admins'));
    }
    public function update(Request $request)
    {
        $user = User::find($request->user_id);
        $user->is_admin = true;
        User::updateUser($user);
        return redirect(route('admin.users.admins'));
    }
}
