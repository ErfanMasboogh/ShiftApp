<?php

use App\Http\Controllers\Admin\CommuteController as AdminCommuteController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\User\CommuteController as UserCommuteController;
use App\Http\Controllers\User\PaymentController as UserPaymentController;
use App\Http\Middleware\AdminCheck;
use App\Http\Middleware\LoginCheck;
use Illuminate\Support\Facades\Route;

Route::middleware(LoginCheck::class)->group(function () {
    // ========================  Admin Panel
    Route::middleware(AdminCheck::class)->group(function () {
        Route::group(['prefix' => 'admin'], function () {
            Route::get('/', [HomeController::class, 'admin'])->name('admin.index');
            // ========== Shifts
            Route::group(['prefix' => 'shifts'], function () {
                Route::get('/new', [ShiftController::class, 'new'])->name('admin.shifts.new');
                Route::Post('/new', [ShiftController::class, 'store']);
                Route::get('/list', [ShiftController::class, 'list'])->name('admin.shifts.list');
                Route::delete('/list/{id}', [ShiftController::class, 'delete'])->name('admin.shifts.list.delete');
            });
            // ========== Commutes
            Route::group(['prefix' => 'commutes'], function () {
                Route::get('/enter', [AdminCommuteController::class, 'enter'])->name('admin.commutes.enter');
                Route::post('/enter', [AdminCommuteController::class, 'create']);
                Route::get('/exit', [AdminCommuteController::class, 'exit'])->name('admin.commutes.exit');
                Route::post('/exit', [AdminCommuteController::class, 'update']);
                Route::get('/list', [AdminCommuteController::class, 'list'])->name('admin.commutes.list');
            });
            // ========== Users
            Route::group(['prefix' => 'users'], function () {
                Route::get('/new', [UserController::class, 'new'])->name('admin.users.new');
                Route::post('/new', [UserController::class, 'store']);
                Route::get('/list', [UserController::class, 'list'])->name('admin.users.list');
                Route::delete('/list/{id}', [UserController::class, 'delete'])->name('admin.users.list.delete');
                Route::post('/list', [UserController::class, 'update']);
                Route::group(['prefix' => 'admins'], function () {
                    Route::get('/', [AdminController::class, 'list'])->name('admin.users.admins');
                    Route::post('/', [AdminController::class, 'update']);
                    Route::delete('/{id}', [AdminController::class, 'delete'])->name('admin.users.admins.delete');
                });
                Route::group(['prefix' => 'roles'], function () {});
                Route::get('/roles', [RoleController::class, 'list'])->name('admin.users.roles');
                Route::delete('/roles/{id}', [RoleController::class, 'delete'])->name('admin.users.roles.delete');
                Route::post('/roles', [RoleController::class, 'update'])->name('admin.users.roles.update');
                Route::post('/roles/new', [RoleController::class, 'store'])->name('admin.users.roles.new');
            });
            // ========== Payments
            Route::group(['prefix' => 'payments'], function () {
                Route::get('/pending', [AdminPaymentController::class, 'pending'])->name('admin.payments.pending');
                Route::post('/pending', [AdminPaymentController::class, 'store']);
                Route::get('/paid', [AdminPaymentController::class, 'paid'])->name('admin.payments.paid');
                Route::get('/details', [AdminPaymentController::class, 'details'])->name('admin.payments.details');
            });
        });
    });
    // ======================== User Panel
    Route::get('/', [HomeController::class, 'user'])->name('index');
    Route::get('/pending', [UserPaymentController::class, 'pending'])->name('pending');
    Route::get('/paid', [UserPaymentController::class, 'paid'])->name('paid');
    Route::get('/details', [UserPaymentController::class, 'details'])->name('details');
    Route::get('/commutes', [UserCommuteController::class, 'list'])->name('commutes');
    // ========================
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
