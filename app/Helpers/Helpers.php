<?php

namespace App\Helpers;

use App\Models\Role;
use App\Models\Shift;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;
use App\Models\Commute;

use function PHPUnit\Framework\isEmpty;

function calculateSalary(Commute $commute,int $role_id):int{
    $now = Carbon::now()->format('H:i:s');
    $date = Carbon::now()->format('Y-m-d');
    $shifts = Shift::all();
    $salary = 0;
    $role_over_payment = Role::find($role_id)->over_payment;
    $miladiEnterDate = Jalalian::fromFormat('Y-m-d', $commute->enter_date)->toCarbon()->format('Y-m-d');
    $enter = strtotime(str($miladiEnterDate . ' ' . $commute->enter));
    $exit = strtotime(str($date . ' ' . $now));
    foreach ($shifts as $shift) {
        $start = strtotime(str($miladiEnterDate . ' ' . $shift->start));
        $end = strtotime(str($date . ' ' . $shift->end));
        if ($exit > $start && $enter < $end) {
            $startTimeForCalculate = max($enter, $start);
            $endTimeForCalculate = min($exit, $end);
            $difference = $endTimeForCalculate - $startTimeForCalculate;
            $hoursWorked = $difference / 60 / 60;
            $salary += $hoursWorked * $shift->wage_per_hour;
            $salary += $hoursWorked * $role_over_payment;
        }
    }
    return $salary;
}
function shiftOverlapCheck($newShiftStartTime, $newShiftEndTime,$isUpdate = false,$updatingShiftId = 1): bool
{
    $shifts = $isUpdate ? Shift::where('id','!=',$updatingShiftId)->get() : Shift::all();
    if ($shifts->isEmpty()) {
        return true;
    }
    $date = Carbon::now()->format('Y-m-d');
    $newShiftStartTimeCarbon = Carbon::parse($date . ' ' . $newShiftStartTime);
    $newShiftEndTimeCarbon = Carbon::parse($date . ' ' . $newShiftEndTime);
    if ($newShiftStartTimeCarbon->gt($newShiftEndTimeCarbon)) {
        $newShiftEndTimeCarbon->addDay();
    }
    foreach ($shifts as $shift) {
        $shiftStartTimeCarbon = Carbon::parse($date . ' ' . $shift->start);
        $shiftEndTimeCarbon = Carbon::parse($date . ' ' . $shift->end);
        if ($shiftStartTimeCarbon->gt($shiftEndTimeCarbon)) {
            $shiftEndTimeCarbon->addDay();
        }
        if ($newShiftStartTimeCarbon->between($shiftStartTimeCarbon, $shiftEndTimeCarbon, true) ||
            $newShiftEndTimeCarbon->between($shiftStartTimeCarbon, $shiftEndTimeCarbon, true) ||
            ($newShiftStartTimeCarbon->lte($shiftStartTimeCarbon) && $newShiftEndTimeCarbon->gte($shiftEndTimeCarbon))
        ) {
            return false;
        }
    }

    return true;
}


