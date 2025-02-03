<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commute;
use App\Models\CommuteDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Morilog\Jalali\Jalalian;
use function App\Helpers\calculateSalary;

class CommuteController extends Controller
{
    public function enter(): InertiaResponse
    {
        $users = User::where('is_admin', 0)->get()->toArray();
        $checkedUsers = [];
        foreach ($users as $user) {
            $commutes = Commute::notExited($user['id'])->get()->toArray();
            if (empty($commutes)) {
                array_push($checkedUsers, $user);
            }
        }
        $context = [
            'users' => $checkedUsers
        ];
        return Inertia::render('Admin/Commutes/Enter', compact('context'));
    }
    public function exit(): InertiaResponse
    {
        $commutes = Commute::where('exit', null)->get()->toArray();
        $users = User::all()->toArray();
        $context = [
            'commutes' => $commutes,
            'users' => $users
        ];
        return Inertia::render('Admin/Commutes/Exit', compact('context'));

    }
    public function list(): InertiaResponse
    {
        $commutes = CommuteDetail::all()->toArray();
        $users = User::all();
        $context = [
            'commutes' => $commutes,
            'users' => $users
        ];
        return Inertia::render('Admin/Commutes/List', compact('context'));

    }
    public function create(Request $request): RedirectResponse // Store enter data
    {
        $now = Carbon::now()->format('H:i:s');
        $date = Carbon::now()->format('Y-m-d');
        $shamsiDate = Jalalian::fromDateTime($date)->format('Y/m/d');

        Commute::createCommute($request->user_id,$now,$shamsiDate);
        CommuteDetail::createCommuteDetail($request->user_id,$now,$shamsiDate);

        return redirect()->route('admin.index');
    }
    public function update(Request $request): RedirectResponse // Store exit data
    {
        $now = Carbon::now()->format('H:i');
        $date = Carbon::now()->format('Y-m-d');
        $commute = Commute::find($request->item_id);
        $shamsiDate = Jalalian::fromDateTime($date)->format('Y/m/d');
        $user = User::find($commute->user_id);
        $salary = calculateSalary($commute,$user->role_id);
        $commute->salary = $salary;
        $commute->exit = $now;
        $commute->exit_date = $shamsiDate;
        Commute::updateCommute($commute);
        CommuteDetail::createCommuteDetail($commute->user_id,$now . ':00',$shamsiDate,1);
        $user->unpaid_salary += $salary;
        User::updateUser($user);

        return redirect()->route('admin.index');
    }
}
