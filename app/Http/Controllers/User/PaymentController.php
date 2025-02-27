<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Commute;
use App\Models\Payment;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class PaymentController extends Controller
{
    public function pending(): InertiaResponse
    {
        $user = User::unpaid(auth()->user()->id)->get()->toArray();
        $context = [
            'users' => $user
        ];
        return Inertia::render('User/Pending', compact('context'));
    }
    public function paid(): InertiaResponse
    {
        $user = User::all()->toArray();
        $payments = Payment::where('user_id', auth()->user()->id)->get()->toArray();
        $context = [
            'users' => $user,
            'payments' => $payments
        ];
        return Inertia::render('User/Paid', compact('context'));
    }
    public function details():InertiaResponse
    {
        $commutes = Commute::exited(auth()->user()->id)->get()->toArray();
        $users = User::all()->toArray();
        $context = [
            'commutes' => $commutes,
            'users' => $users
        ];
        return Inertia::render('User/Details', compact('context'));
    }
}
