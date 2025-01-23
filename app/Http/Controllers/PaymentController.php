<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Commute;
use App\Models\Payment;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class PaymentController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Payments/Index');
    }
    public function pending()
    {
        $users = User::where('salary', '!=', '0')->get()->toArray();
        $context = [
            'users' => $users
        ];
        return Inertia::render('Admin/Payments/Pending', compact('context'));
    }
    public function paid()
    {
        $users = User::all()->toArray();
        $payments = Payment::all()->toArray();
        $context = [
            'users' => $users,
            'payments' => $payments
        ];
        return Inertia::render('Admin/Payments/Paid', compact('context'));
    }
    public function details()
    {
        $commutes = Commute::where('salary', '!=', 0)->get()->toArray();
        $users = User::all()->toArray();
        $context = [
            'commutes' => $commutes,
            'users' => $users
        ];
        return Inertia::render('Admin/Payments/Details', compact('context'));
    }

    public function userPending()
    {
        $user = User::where([['salary', '!=', '0'], ['id', auth()->user()->id]])->get()->toArray();
        $context = [
            'users' => $user
        ];
        return Inertia::render('User/Pending', compact('context'));
    }
    public function userPaid()
    {
        $user = User::all()->toArray();
        $payments = Payment::where('user_id', auth()->user()->id)->get()->toArray();
        $context = [
            'users' => $user,
            'payments' => $payments
        ];
        return Inertia::render('User/Paid', compact('context'));
    }
    public function userDetails()
    {
        $commutes = Commute::where([['salary', '!=', 0], ['user_id', auth()->user()->id]])->get()->toArray();
        $users = User::all()->toArray();
        $context = [
            'commutes' => $commutes,
            'users' => $users
        ];
        return Inertia::render('User/Details', compact('context'));
    }

    public function pendingStore(Request $request)
    {
        $date = Carbon::now()->format('Y:m:d');
        $date = preg_replace('/:/', '-', $date, 2);
        $shamsiDate = Jalalian::fromDateTime($date)->format('Y/m/d');
        $user = User::find($request->item_id);
        $payment = new Payment;
        $payment->user_id = $user->id;
        $payment->amount = $user->salary;
        $payment->date = $shamsiDate;
        $payment->save();

        $user->salary = 0;
        $user->save();

        $commutes = Commute::where([['user_id', $user->id], ['is_paid', 0]])->get();
        foreach ($commutes as $commute) {
            $commute->is_paid = 1;
            $commute->save();
        }
        return redirect(route('admin.index'));
    }
}
