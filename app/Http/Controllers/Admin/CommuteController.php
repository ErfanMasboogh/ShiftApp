<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commute;
use App\Models\CommuteDetail;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Morilog\Jalali\Jalalian;
use function App\Helpers\calculateSalary;

class CommuteController extends Controller
{
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
        $commutes = CommuteDetail::all()->toArray();
        $users = User::all();
        $context = [
            'commutes' => $commutes,
            'users' => $users
        ];
        return Inertia::render('Admin/Commutes/List', compact('context'));

    }
    public function create(Request $request) // Store enter data
    {
        $now = Carbon::now()->format('H:i');
        $date = Carbon::now()->format('Y:m:d');
        $date = preg_replace('/:/', '-', $date, 2);
        $shamsiDate = Jalalian::fromDateTime($date)->format('Y/m/d');

        Commute::createCommute($request->user_id,$now . ':00',$shamsiDate);
        CommuteDetail::createCommuteDetail($request->user_id,$now . ':00',$shamsiDate);

        return redirect(route('admin.index'));
    }
    public function update(Request $request) // Store exit data
    {
        $commute = Commute::find($request->item_id);
        $now = Carbon::now()->format('H:i');
        $date = Carbon::now()->format('Y:m:d');
        $date = preg_replace('/:/', '-', $date, 2);
        $shamsiDate = Jalalian::fromDateTime($date)->format('Y/m/d');
        $salary = calculateSalary($commute);
        $commute->salary = $salary;
        $commute->exit = $now;
        $commute->exit_date = $shamsiDate;
        Commute::updateCommute($commute);
        CommuteDetail::createCommuteDetail($commute->user_id,$now . ':00',$shamsiDate,1);
        $user = User::find($commute->user_id);
        $user->unpaid_salary += $salary;
        User::updateUser($user);

        return redirect(route('admin.index'));
    }
}
