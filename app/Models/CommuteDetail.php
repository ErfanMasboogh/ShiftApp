<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommuteDetail extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
