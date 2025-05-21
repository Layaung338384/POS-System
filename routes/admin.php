<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\AdminController;

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

});


