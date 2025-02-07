<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Carbon\Carbon;
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

    public function store(Request $request)
    {
        if ($request->start == $request->end) {
            $error = 'زمان شروع و پایان شیفت نمیتواند یکسان باشد.';
            return Inertia::render('Admin/Shifts/New', compact('error'));
        }
        dd(shiftOverlapCheck($request->start, $request->end));
        // Logic
    }

    // two method remained: update & delete
}
