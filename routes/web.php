<?php

use App\Http\Controllers\Tenant\AuthController;
use App\Http\Controllers\Tenant\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('signup', [AuthController::class, 'signup'])->name('signup');
Route::get('login', [AuthController::class, 'login'])->name('login');

// Form email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');

// For tentans
Route::get('tenants/{account}/login', [AuthController::class, 'showLoginForm'])->name('tenants.login');
Route::post('tenants/{account}/login', [AuthController::class, 'login'])->name('tenants.postLogin');

Route::group(['middleware' => ['auth:web']], function() {
    Route::get('/{account}/home', function () {
        return view('tenants.home');
    })->name('tenants.home');

    // FOr profile
    Route::get('/{account}/profile', [ProfileController::class, 'showProfileForm'])->name('tenants.profile');
    Route::post('/{account}/save/profile', [ProfileController::class, 'saveProfile'])->name('tenants.postprofile');

    // For logout
    Route::get('/{account}/logout', [AuthController::class, 'logout'])->name('tenants.logout');
});