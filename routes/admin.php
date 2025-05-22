<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('home', [AdminController::class, 'home'])->name('adminHome');

    //category
    Route::group(['prefix' => 'category'], function(){
        Route::get('page', [CategoryController::class, 'list'])->name('categoryPage');
        Route::post('create',[CategoryController::class,'create'])->name("categoryCreate");
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('categoryDelete');

        //Category update
        Route::get('updatePage/{id}',[CategoryController::class,'updatePage'])->name("updatePage");
        Route::post("update",[CategoryController::class,'update'])->name('update');
    });

    Route::group(['prefix' => 'profile'] , function(){
        //change pasword section
        Route::get("changePasswordPage",[ProfileController::class,'changePasswordPage'])->name('changePasswordPage');
        Route::post("changePassword",[ProfileController::class,'change'])->name("changePassword");

        //profile => list => edit
        Route::get("account",[ProfileController::class,'list'])->name("accountlist");
        Route::get('editPage',[ProfileController::class,'editPage'])->name("editPage");
        Route::post("edit",[ProfileController::class,'edit'])->name("edit");
    });

});


