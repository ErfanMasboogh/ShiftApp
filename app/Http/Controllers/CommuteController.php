<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Shift;
use App\Models\Commute;
use App\Models\CommuteList;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class CommuteController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Commutes/Index');
    }
    public function enter()
    {
        $users = User::where('is_admin', 0)->get()->toArray();
        $checkedUsers = [];
        foreach ($users as $user) {
            $commutes = Commute::where([['user_id', $user['id']], ['exit', null]])->get()->toArray();
            if (empty($commutes)) {
                array_push($checkedUsers, $user);
            }
        }
        $context = [
            'users' => $checkedUsers
        ];
        return Inertia::render('Admin/Commutes/Enter', compact('context'));
    }
    public function exit()
    {
        $commutes = Commute::where('exit', null)->get()->toArray();
        $users = User::all()->toArray();
        $context = [
            'commutes' => $commutes,
            'users' => $users
        ];
        return Inertia::render('Admin/Commutes/Exit', compact('context'));

    }
    public function list()
    {
        $commutes = CommuteList::all()->toArray();
        $users = User::all();
        $context = [
            'commutes' => $commutes,
            'users' => $users
        ];
        return Inertia::render('Admin/Commutes/List', compact('context'));

    }
    public function userCommutes()
    {
        $commutes = CommuteList::where('user_id', auth()->user()->id)->get()->toArray();
        $users = User::all()->toArray();
        $context = [
            'commutes' => $commutes,
            'users' => $users
        ];
        return Inertia::render('User/Commutes', compact('context'));
    }
    public function enterStore(Request $request)
    {
        // $date = Carbon::now()->format('Y:m:d') . ' ' . $request->enter;
        // $dateString = preg_replace('/:/', '-', $date, 2);
        // $carbonDate = Carbon::createFromFormat('Y-m-d H:i', $dateString)->timestamp;
        $now = Carbon::now()->format('H:i');
        $date = Carbon::now()->format('Y:m:d');
        $date = preg_replace('/:/', '-', $date, 2);
        $shamsiDate = Jalalian::fromDateTime($date)->format('Y/m/d');
        $commute = new Commute;
        $commute->user_id = $request->user_id;
        $commute->enter = $now . ':00';
        $commute->enter_date = $shamsiDate;
        $commute->save();
        $commute_list = new CommuteList;
        $commute_list->user_id = $request->user_id;
        $commute_list->time = $now . ':00';
        $commute_list->date = $shamsiDate;
        $commute_list->save();

        return redirect(route('admin.index'));
    }
    public function exitStore(Request $request)
    {
        $commute = Commute::find($request->item_id);
        $now = Carbon::now()->format('H:i');
        $date = Carbon::now()->format('Y:m:d');
        $date = preg_replace('/:/', '-', $date, 2);
        $shamsiDate = Jalalian::fromDateTime($date)->format('Y/m/d');
        // Salary Calculation
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
                $diffrence = $endTimeForCalculate - $startTimeForCalculate;
                $hoursWorked = $diffrence / 60 / 60;
                $salary += $hoursWorked * $shift->wage;
            }
        }
        // -------
        $commute->salary = $salary;
        $commute->exit = $now;
        $commute->exit_date = $shamsiDate;
        $commute->save();

        $commute_list = new CommuteList;
        $commute_list->user_id = $commute->user_id;
        $commute_list->time = $now . ':00';
        $commute_list->is_exit = 1;
        $commute_list->date = $shamsiDate;
        $commute_list->save();

        $user = User::find($commute->user_id);
        $user->salary += $salary;
        $user->save();
        return redirect(route('admin.index'));

    }
}
