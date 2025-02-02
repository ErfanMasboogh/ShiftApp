<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commute;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Morilog\Jalali\Jalalian;

class PaymentController extends Controller
{
    public function pending(): InertiaResponse
    {
        $users = User::where('unpaid_salary', '!=', null)->get()->toArray();
        $context = [
            'users' => $users
        ];
        return Inertia::render('Admin/Payments/Pending', compact('context'));
    }
    public function paid(): InertiaResponse
    {
        $users = User::all()->toArray();
        $payments = Payment::all()->toArray();
        $context = [
            'users' => $users,
            'payments' => $payments
        ];
        return Inertia::render('Admin/Payments/Paid', compact('context'));
    }
    public function details(): InertiaResponse
    {
        $commutes = Commute::where('salary', '!=', 0)->get()->toArray();
        $users = User::all()->toArray();
        $context = [
            'commutes' => $commutes,
            'users' => $users
        ];
        return Inertia::render('Admin/Payments/Details', compact('context'));
    }
    public function store(Request $request): RedirectResponse
    {
        $date = Carbon::now()->format('Y-m-d');
        $shamsiDate = Jalalian::fromDateTime($date)->format('Y/m/d');
        $user = User::find($request->item_id);
        Payment::createPayment($user->id, $user->unpaid_salary, $shamsiDate);
        $user->unpaid_salary = null;
        User::updateUser($user);

        $commutes = Commute::unpaid($user->id)->get();
        foreach ($commutes as $commute) {
            $commute->is_paid = 1;
            Commute::updateCommute($commute);
        }
        return redirect()->route('admin.index');
    }
}
