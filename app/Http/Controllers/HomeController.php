<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class HomeController extends Controller
{
    public function admin(): InertiaResponse
    {
        return Inertia::render('Admin/Index');
    }
    public function user(): InertiaResponse
    {
        return Inertia::render('User/Index');
    }
}
