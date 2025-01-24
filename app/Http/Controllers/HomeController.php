<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function adminIndex()
    {
        $role = Role::where('name', 'ساده')->count();
        if (!$role) {
            $defaultRole = new Role;
            $defaultRole->name = 'ساده';
            $defaultRole->over_payment = 0;
            $defaultRole->save();
        }
        return Inertia::render('Admin/Index');
    }
    public function userIndex()
    {
        return Inertia::render('User/Index');
    }
}
