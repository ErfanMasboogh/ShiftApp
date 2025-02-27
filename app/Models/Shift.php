<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    public static function createShift($name,$wage_per_hour,$start,$end): Shift{
        $shift = new Shift();
        $shift->name = $name;
        $shift->wage_per_hour = $wage_per_hour;
        $shift->start = $start;
        $shift->end = $end;
        $shift->save();
        return $shift;
    }
    public static function deleteShift($id):bool
    {
        return Shift::find($id)->delete();
    }
    public static function updateShift(Shift $shift): Shift{
        $shift->save();
        return $shift;
    }
}
