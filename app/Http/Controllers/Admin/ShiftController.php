<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShiftController extends Controller
{
    public function new()
    {
        return Inertia::render('Admin/Shifts/New');
    }
    public function list()
    {
        return Inertia::render('Admin/Shifts/List');
    }
    public function store(Request $request)
    {
        $shifts = shift::all();
        $date = Carbon::now()->format('Y-m-d');
        $newStart = strtotime(str($date . ' ' . $request->start));
        $newEnd = strtotime(str($date . ' ' . $request->end));
        if ($newStart == $newEnd) {
            $error = 'زمان شروع و پایان شیفت نمیتواند یکسان باشد.';
            return Inertia::render('Admin/Shifts/New', compact('error'));
        }
        foreach ($shifts as $shift) {
            $shiftStart = strtotime(str($date . ' ' . $shift->start));
            $shiftEnd = strtotime(str($date . ' ' . $shift->end));
            if ($newStart > $shiftStart && $newEnd < $shiftEnd || $newStart < $shiftStart && $newEnd > $shiftEnd || $newStart < $shiftEnd && $newEnd >= $shiftEnd || $newStart <= $shiftStart && $newEnd > $shiftStart) {
                $error = 'شیفت وارد شده با دیگر شیفت ها تداخل دارد.';
                return Inertia::render('Admin/Shifts/New', compact('error'));
            }
        }

        dd('Yeeees');

        // $newEnd = $newEnd < $newStart ? $newEnd->addDay() : $newEnd;


        // dd($newStart, $newEnd);

        // $overlappingShifts = Shift::where(function ($query) use ($newStart, $newEnd) {
        //     $query->where(function ($q) use ($newStart, $newEnd) {
        //         $q->whereBetween('start', [$newStart, $newEnd])
        //             ->orWhereBetween('end', [$newStart, $newEnd]);
        //     })
        //         ->orWhere(function ($q) use ($newStart, $newEnd) {
        //             $q->where('start', '>=', $newStart)
        //                 ->where('end', '<=', $newEnd);
        //         })
        //         ->orWhere(function ($q) use ($newStart, $newEnd) {
        //             $q->where('start', '<=', $newStart)
        //                 ->where('end', '>=', $newEnd);
        //         });
        // })->get();

    }

    // two method remained: update & delete
}
