<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CommuteDetail;
use App\Models\User;
use Inertia\Inertia;

class CommuteController extends Controller
{
    public function list()
    {
        $commutes = CommuteDetail::where('user_id', auth()->user()->id)->get()->toArray();
        $users = User::all()->toArray();
        $context = [
            'commutes' => $commutes,
            'users' => $users
        ];
        return Inertia::render('User/Commutes', compact('context'));
    }
}
