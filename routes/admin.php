<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('home', [AdminController::class, 'home'])->name('adminHome');

    //payment
    Route::group(['prefix' => 'payment'],function(){
        Route::get('paymentPage',[PaymentController::class,'paymentPage'])->name("payment");
        Route::post("Create",[PaymentController::class,'paymentCreate'])->name('paymentCreate');
        Route::get('updatePage/{id}',[PaymentController::class,'updatePage'])->name('paymentUpdatePage');
        Route::post('update',[PaymentController::class,'update'])->name("paymentUpdate");
        Route::get('delete/{id}',[PaymentController::class,'delete'])->name('paymentDelete');
    });

    //order
    Route::group(['prefix' => 'order'],function(){
        Route::get('orderlist',[OrderController::class,'orderListPage'])->name('adminorderListPage');
        Route::get('orderDetails/{order_code}',[OrderController::class,'details'])->name('AdminOrdeDetails');
        Route::get('changeStatus',[OrderController::class,'changeStatus']);
        Route::get('confirm',[OrderController::class,'confirm'])->name('AdminOrderConfirm');
        Route::get('rejectOrder',[OrderController::class,'reject'])->name('AdminOrderReject');
    });

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

        //profile => Manage New Admin
       Route::group(['middleware' => 'superadmin'], function (){
            Route::get('newadminPage',[ProfileController::class,'newadminpage'])->name('addNewAdminPage');
            Route::post("newadmin",[ProfileController::class,'create'])->name('createAdmin');

            //admin list show => delete section
            Route::get("adminlist",[ProfileController::class,'adminlist'])->name('adminlist');
            Route::get('adminDelete/{id}',[ProfileController::class,'adminDelete'])->name("admindelete");

            //user list show => delete section
            Route::get('userlist',[ProfileController::class,'userlist'])->name("userlist");
       });

       //product => create => list => details => update => delete
       Route::group(['prefix' => 'product'],function (){

        //product create section
        Route::get('CreatePage',[ProductController::class,'create'])->name("productCreatePage");
        Route::post("Create",[ProductController::class,'productCreate'])->name("productCreate");


        //product list and delete section
        Route::get("list/{amt?}",[ProductController::class,'productList'])->name("productList");
        Route::get('delete/{id}', [ProductController::class, 'productDelete'])->name('productDelete');

        //product//update section
        Route::get("update/{id}",[ProductController::class,'updatePage'])->name('productupdatePage');
        Route::post('update',[ProductController::class,'updateProduct'])->name('updateProduct');

        //product details
        Route::get("details/{id}",[ProductController::class,'productDetails'])->name('productDetails');
       });
    });

});


