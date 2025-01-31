<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function admin()
    {
        return Inertia::render('Admin/Index');
    }
    public function user()
    {
        return Inertia::render('User/Index');
    }
}
