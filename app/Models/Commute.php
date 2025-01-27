<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commute extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function createCommute($user_id,$enter,$date): Commute{
        $commute = new Commute;
        $commute->user_id = $user_id;
        $commute->enter = $enter;
        $commute->date = $date;
        $commute->save();
        return $commute;
    }
    public function updateCommute(Commute $commute): Commute{
        $commute->save();
        return $commute;
    }
}
