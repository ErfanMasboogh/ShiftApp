<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shift\StoreRequest;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use function App\Helpers\shiftOverlapCheck;

class ShiftController extends Controller
{
    public function new(): InertiaResponse
    {
        return Inertia::render('Admin/Shifts/New');
    }

    public function list(): InertiaResponse
    {
        return Inertia::render('Admin/Shifts/List');
    }

    public function store(StoreRequest $request): InertiaResponse|RedirectResponse
    {
        if ($request->start == $request->end) {
            $error = 'زمان شروع و پایان شیفت نمیتواند یکسان باشد.';
            return Inertia::render('Admin/Shifts/New', compact('error'));
        }
        $overlap_status = shiftOverlapCheck($request->start, $request->end);
        if ($overlap_status) {
            Shift::createShift($request->name,$request->wage_per_hour,$request->start,$request->end);
            return redirect()->route('admin.shifts.list');
        }else{
            $error = 'شیفت وارد شده با دیگر شیفت ها تداخل دارد.';
            return Inertia::render('Admin/Shifts/New', compact('error'));
        }
    }

    // two method remained: update & delete
}
