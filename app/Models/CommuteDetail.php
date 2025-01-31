<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class CommuteDetail extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function createCommuteDetail($user_id,$time,$date, int $is_exit = 0): CommuteDetail{
        $commuteDetail = new CommuteDetail;
        $commuteDetail->user_id = $user_id;
        $commuteDetail->time = $time;
        $commuteDetail->date = $date;
        $commuteDetail->is_exit = $is_exit;
        $commuteDetail->save();
        return $commuteDetail;
    }
}
