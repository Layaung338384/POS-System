<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\indexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialLoginController;

// Load other route files
require_once __DIR__.'/admin.php';
require_once __DIR__.'/user.php';

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', 'indexPage');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
require __DIR__.'/auth.php';

Route::get('indexPage', [indexController::class,'index'])->name("index");
Route::get('infoPage', [indexController::class,'info'])->name("info");


Route::get('/auth/{provider}/redirect', [SocialLoginController::class, 'redirect'])->name('socialLogin');


Route::get('/auth/{provider}/callback',[SocialLoginController::class,'callback']);
