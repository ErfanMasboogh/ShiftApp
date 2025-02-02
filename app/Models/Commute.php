<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commute extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function createCommute($user_id,$enter,$date): Commute{
        $commute = new Commute;
        $commute->user_id = $user_id;
        $commute->enter = $enter;
        $commute->date = $date;
        $commute->save();
        return $commute;
    }
    public static function updateCommute(Commute $commute): Commute{
        $commute->save();
        return $commute;
    }
    public function scopeUnpaid($query,$user_id)
    {

        return $query->where('user_id',$user_id)
        ->where('is_paid',0);
    }
}
