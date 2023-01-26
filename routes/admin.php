<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::get("login", [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post("login", [AuthController::class, 'login'])->name('admin.postLogin');

Route::group(['middleware' => ['auth:admin']], function() {
    Route::get('dshboard', function() {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
});