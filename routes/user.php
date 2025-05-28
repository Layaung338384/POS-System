<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProductController;
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

    Route::group(['prefix' => 'product'],function(){
        Route::get("details/{id}",[ProductController::class,'details'])->name("detailsPage");
        Route::post('addToCard',[ProductController::class,'addtoCard'])->name("addtoCard");
        Route::get('cart',[ProductController::class,'addCart'])->name("addToCart");
        Route::get('cart/delete',[ProductController::class,'cartsDelete'])->name('cartDelete');

        //api test
        Route::get('listPage',[ProductController::class,'productList']);
    });
});




