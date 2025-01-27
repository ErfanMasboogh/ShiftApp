<?php

namespace App\Helpers;

use App\Models\Shift;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;
use App\Models\Commute;
use phpDocumentor\Reflection\Types\Integer;

function calculateSalary(Commute $commute):Integer{
    $now = Carbon::now()->format('H:i');
    $date = Carbon::now()->format('Y:m:d');
    $date = preg_replace('/:/', '-', $date, 2);
    $shifts = Shift::all();
    $salary = 0;
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
        }
    }
    return $salary;
}
