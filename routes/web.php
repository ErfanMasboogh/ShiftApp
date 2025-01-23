<?php

use App\Http\Controllers\CommuteController;
use App\Http\Controllers\FinancialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminCheck;
use App\Http\Middleware\LoginCheck;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
            Route::get('/', [HomeController::class, 'index'])->name('admin.index');
            // ========== Shifts
            Route::group(['prefix' => 'shifts'], function () {
                // Route::get('/', [ShiftController::class, 'index'])->name('admin.shifts.index');
                Route::get('/new', [ShiftController::class, 'new'])->name('admin.shifts.new');
                Route::Post('/new', [ShiftController::class, 'store']);
                Route::get('/list', [ShiftController::class, 'list'])->name('admin.shifts.list');
            });
            // ========== Commutes
            Route::group(['prefix' => 'commutes'], function () {
                // Route::get('/', [CommuteController::class, 'index'])->name('admin.commutes.index');
                Route::get('/enter', [CommuteController::class, 'enter'])->name('admin.commutes.enter');
                Route::post('/enter', [CommuteController::class, 'enterStore']);
                Route::get('/exit', [CommuteController::class, 'exit'])->name('admin.commutes.exit');
                Route::post('/exit', [CommuteController::class, 'exitStore']);
                Route::get('/list', [CommuteController::class, 'list'])->name('admin.commutes.list');
            });
            // ========== Users
            Route::group(['prefix' => 'users'], function () {
                // Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
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
                // Route::get('/', [PaymentController::class, 'index'])->name('admin.payments.index');
                Route::get('/pending', [PaymentController::class, 'pending'])->name('admin.payments.pending');
                Route::post('/pending', [PaymentController::class, 'pendingStore']);
                Route::get('/paid', [PaymentController::class, 'paid'])->name('admin.payments.paid');
                Route::get('/details', [PaymentController::class, 'details'])->name('admin.payments.details');
            });
        });
    });
    // ======================== Other
    Route::get('/', [HomeController::class, 'userIndex'])->name('index');
    Route::get('/pending', [PaymentController::class, 'userPending'])->name('pending');
    Route::get('/paid', [PaymentController::class, 'userPaid'])->name('paid');
    Route::get('/details', [PaymentController::class, 'userDetails'])->name('details');
    Route::get('/commutes', [CommuteController::class, 'userCommutes'])->name('commutes');
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
