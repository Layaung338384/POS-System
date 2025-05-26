<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProfileController;


Route::group(['prefix' => 'user' , 'middleware' => 'user'], function () {
    Route::get('home', [UserController::class,'home'])->name('userHome');


    Route::group(['prefix' => 'profile'], function(){
        Route::get("list",[ProfileController::class,'list'])->name("profileList");
        Route::get("updatePage",[ProfileController::class,'updatePage'])->name("profileUpdatePage");
        Route::post('update',[ProfileController::class,'update'])->name('profileUpdate');

        //changePassword Section
        Route::get('changePwdPage',[ProfileController::class,'changePwdPage'])->name("changePwdPage");
        Route::post("changeUserPwd",[ProfileController::class,'changeUserPwd'])->name("changeUserPwd");
    });

});


