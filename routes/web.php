<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/logs', function () {
    return view('logs');
})->middleware(['auth', 'verified'])->name('logs');

Route::get('/admin', function () {
    return view('admin.index');
})->middleware(['auth', 'role:admin'])->name('admin.index');


Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    // Route::post('/movie/export', [MovieController::class, 'exportExcel'])->name('movie.excel');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/logs', [UserController::class, 'logs'])->name('user.logs');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('users/export-excel', [UserController::class, 'exportExcel'])->name('users.download-excel');



Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::post('/user/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

require __DIR__.'/auth.php';
