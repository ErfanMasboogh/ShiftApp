<?php

use App\Http\Controllers\Admin\CommuteController as AdminCommuteController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FinancialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\User\CommuteController as UserCommuteController;
use App\Http\Controllers\User\PaymentController as UserPaymentController;
use App\Http\Middleware\AdminCheck;
use App\Http\Middleware\LoginCheck;
use Illuminate\Support\Facades\Route;

Route::middleware(LoginCheck::class)->group(function () {
    // Route::get('/', function () {
    //     return Inertia::render('Welcome', [
    //         'canLogin' => Route::has('login'),
    //         'canRegister' => Route::has('register'),
    //         'laravelVersion' => Application::VERSION,
    //         'phpVersion' => PHP_VERSION,
    //     ]);
    // });
    // ========================  Admin
    Route::middleware(AdminCheck::class)->group(function () {
        Route::group(['prefix' => 'admin'], function () {
            Route::get('/', [HomeController::class, 'adminIndex'])->name('admin.index');
            // ========== Shifts
            Route::group(['prefix' => 'shifts'], function () {
                Route::get('/new', [ShiftController::class, 'new'])->name('admin.shifts.new');
                Route::Post('/new', [ShiftController::class, 'store']);
                Route::get('/list', [ShiftController::class, 'list'])->name('admin.shifts.list');
            });
            // ========== Commutes
            Route::group(['prefix' => 'commutes'], function () {
                Route::get('/enter', [AdminCommuteController::class, 'enter'])->name('admin.commutes.enter');
                Route::post('/enter', [AdminCommuteController::class, 'enterStore']);
                Route::get('/exit', [AdminCommuteController::class, 'exit'])->name('admin.commutes.exit');
                Route::post('/exit', [AdminCommuteController::class, 'exitStore']);
                Route::get('/list', [AdminCommuteController::class, 'list'])->name('admin.commutes.list');
            });
            // ========== Users
            Route::group(['prefix' => 'users'], function () {
                Route::get('/new', [UserController::class, 'new'])->name('admin.users.new');
                Route::post('/new', [UserController::class, 'newStore']);
                Route::get('/list', [UserController::class, 'list'])->name('admin.users.list');
                Route::delete('/list/{id}', [UserController::class, 'listDelete'])->name('admin.users.list.delete');
                Route::post('/list', [UserController::class, 'listUpdate']);
                Route::get('/admins', [UserController::class, 'admins'])->name('admin.users.admins');
                Route::delete('/admins/{id}', [UserController::class, 'adminsDelete'])->name('admin.users.admins.delete');
                Route::post('/admins', [UserController::class, 'adminsNew']);
                Route::get('/roles', [UserController::class, 'roles'])->name('admin.users.roles');
                Route::delete('/roles/{id}', [UserController::class, 'rolesDelete'])->name('admin.users.roles.delete');
                Route::post('/roles', [UserController::class, 'rolesUpdate'])->name('admin.users.roles.update');
                Route::post('/roles/new', [UserController::class, 'rolesStore'])->name('admin.users.roles.new');
            });
            // ========== Payments
            Route::group(['prefix' => 'payments'], function () {
                Route::get('/pending', [AdminPaymentController::class, 'pending'])->name('admin.payments.pending');
                Route::post('/pending', [AdminPaymentController::class, 'pendingStore']);
                Route::get('/paid', [AdminPaymentController::class, 'paid'])->name('admin.payments.paid');
                Route::get('/details', [AdminPaymentController::class, 'details'])->name('admin.payments.details');
            });
        });
    });
    // ======================== Other
    Route::get('/', [HomeController::class, 'userIndex'])->name('index');
    Route::get('/pending', [UserPaymentController::class, 'pending'])->name('pending');
    Route::get('/paid', [UserPaymentController::class, 'paid'])->name('paid');
    Route::get('/details', [UserPaymentController::class, 'details'])->name('details');
    Route::get('/commutes', [UserCommuteController::class, 'commutes'])->name('commutes');
    // ========================
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
