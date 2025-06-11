<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ProfileController;


Route::group(['prefix' => 'user' , 'middleware' => 'user'], function () {
    Route::get('home', [UserController::class,'home'])->name('userHome');

    //cart section => payment section
    Route::get('payment',[ProductController::class,'payment'])->name('paymentPage');
    Route::get('cart/tempo',[ProductController::class,'cartTempo'])->name('cartTempo');

    //order list
    Route::group(['prefix' => 'order'],function(){
        Route::post('order',[ProductController::class,'order'])->name('productOrder');
        Route::get('orderList',[ProductController::class,'orderlist'])->name('orderListPage');
    });

    //rating
    Route::group(['prefix' => 'rating'],function(){
        Route::post('ratingProduct', [RatingController::class, 'rating'])->name('ratingProduct');
    });

    //comments section
    Route::group(['prefix' => 'comments'],function(){
        Route::post("comments",[ProductController::class,'comment'])->name('comments');
        Route::get('commentsDelete/{id}',[ProductController::class,'commentDelete'])->name('commentDelete');
    });

    //contact/report to admin
    Route::group(['prefix' => 'contact'],function(){
        Route::get('contactPage',[ContactController::class,'contactPage'])->name('contactPage');
        Route::post('contact',[ContactController::class,'contact'])->name('contact');
    });

    //profile CRUD
    Route::group(['prefix' => 'profile'], function(){
        Route::get("list",[ProfileController::class,'list'])->name("profileList");
        Route::get("updatePage",[ProfileController::class,'updatePage'])->name("profileUpdatePage");
        Route::post('update',[ProfileController::class,'update'])->name('profileUpdate');

        //changePassword Section
        Route::get('changePwdPage',[ProfileController::class,'changePwdPage'])->name("changePwdPage");
        Route::post("changeUserPwd",[ProfileController::class,'changeUserPwd'])->name("changeUserPwd");
    });

    //product and cart
    Route::group(['prefix' => 'product'],function(){
        Route::get("details/{id}",[ProductController::class,'details'])->name("detailsPage");
        Route::post('addToCard',[ProductController::class,'addtoCard'])->name("addtoCard");
        Route::get('cart',[ProductController::class,'addCart'])->name("addToCart");
        Route::post('cart/v2',[ProductController::class,'addtoCardV2'])->name("addtoCardV2");
        Route::get('cart/delete',[ProductController::class,'cartsDelete'])->name('cartDelete');

        //api test
        Route::get('listPage',[ProductController::class,'productList']);
    });

});




