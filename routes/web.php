<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| Redirect Root
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| USER DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware('auth')->name('user.dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth','admin'])->group(function () {

    Route::get('/dashboard', function () {
        $users = User::latest()->take(5)->get();
        return view('admin.dashboard', compact('users'));
    })->name('admin.dashboard');

});

Route::middleware('auth')->group(function () {

    Route::get('/profile', function () {
        return view('user.profile');
    })->name('profile');

    Route::post('/profile/update', [App\Http\Controllers\UserController::class, 'update'])->name('profile.update');

});

use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('users', App\Http\Controllers\Admin\UserManagementController::class);
});

Route::get('reports', 
    [\App\Http\Controllers\Admin\ReportController::class, 'index']
)->name('reports.index');

Route::get('reports/export/pdf', 
    [\App\Http\Controllers\Admin\ReportController::class, 'exportPdf']
)->name('reports.export.pdf');

Route::get('settings', 
    [\App\Http\Controllers\Admin\SettingController::class, 'index']
)->name('settings.index');

Route::post('settings', 
    [\App\Http\Controllers\Admin\SettingController::class, 'update']
)->name('settings.update');

Route::middleware('auth')->group(function () {

    Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');

    Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');

    Route::post('/tasks/update', [TaskController::class, 'updateStatus'])->name('task.update');

    Route::post('/tasks/delete', [TaskController::class, 'delete'])->name('task.delete');

    Route::post('/tasks/edit', [TaskController::class, 'edit'])->name('task.edit');

});