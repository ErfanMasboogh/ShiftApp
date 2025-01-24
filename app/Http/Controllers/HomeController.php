<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function admin()
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
    public function user()
    {
        return Inertia::render('User/Index');
    }
}
