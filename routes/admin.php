<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;



Route::group(['prefix' => 'admin' , 'middleware' => 'admin'], function () {
    Route::get('home', [AdminController::class,'home'])->name('adminHome');
});


