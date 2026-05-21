<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Admin\UserController;

Route::get('/admin/users', [UserController::class, 'index'])
    ->middleware(['auth'])
    ->name('admin.users');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    return view('dashboard', [
        'usersCount' => User::count(),
        'latestUsers' => User::latest()->take(5)->get()
    ]);

})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::delete('/admin/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('admin.users.destroy');


Route::get('/admin/users/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])
    ->middleware(['auth'])
    ->name('admin.users.edit');

Route::put('/admin/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])
    ->middleware(['auth'])
    ->name('admin.users.update');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'index']);
});
    
Route::get('/about-project', function () {
    return view('about-project');
});

require __DIR__.'/auth.php';
