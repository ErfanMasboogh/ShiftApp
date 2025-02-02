<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function createPayment($user_id,$amount,$date): Payment{
        $payment = new Payment;
        $payment->user_id = $user_id;
        $payment->amount = $amount;
        $payment->date = $date;
        $payment->save();
        return $payment;
    }
}
