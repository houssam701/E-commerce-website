<?php

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\authController;
use App\Http\Controllers\CheckoutController;


Route::get('/admin/clients',[AdminController::class,"showClients"])->middleware('auth');
Route::get('/admin-adding',[MainController::class,"adminAdding"])->middleware('auth');
Route::get('/admin-view-products',[MainController::class,"adminViewProducts"])->middleware('auth');
Route::post('/addingProduct',[AdminController::class,"addingProduct"])->middleware('auth');
Route::post('/adding/type',[AdminController::class,"addingType"])->middleware('auth');
Route::get('/admin/edit/product/{product}',[MainController::class,"editProductPage"])->middleware('auth');
Route::post('/editProduct/{product}',[AdminController::class,"editProduct"])->middleware('auth');
Route::post('/search/product',[MainController::class,"searchProduct"])->middleware('auth');
Route::post('/product/delete', [AdminController::class, 'delete'])->name('products.destroy')->middleware('auth');
Route::post('/type/delete',[AdminController::class,'typeDelete'])->name('deleteType')->middleware('auth');
Route::get('/login',[authController::class,'loginPage'])->name('login')->middleware('guest');
Route::post('/log',[authController::class,'login'])->middleware('guest');
Route::post('/signup',[authController::class,'signUp'])->middleware('guest');
Route::get('/signup',[authController::class,'signUpPage'])->middleware('guest');
Route::get('/logout',[authController::class,'logout'])->middleware('auth');

//ends for admin
Route::get('/home',[UserController::class,'viewHome']);
Route::get('/view/product/{product}',[UserController::class,'viewProduct']);
Route::get('/view/products/{type}',[UserController::class,'viewProductType']);
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');    
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CheckoutController::class, 'showCheckOut'])->name('checkout.show');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.store');
Route::get('/done/order/{order}',[AdminController::class,'doneOrder']);
Route::get('/delete/order/{order}',[AdminController::class,'deleteOrder']);
Route::post('/order/delete',[AdminController::class,'orderDelete']);
Route::post('/order/done',[AdminController::class,'orderDone']);
Route::get('/admin/video',[MainController::class,'addingVideo']);
Route::post('/admin/add/video',[AdminController::class,'addVideo']);
Route::get('/video/delete/{id}',[AdminController::class,'deleteVideo']);
Route::post('/product/search',[MainController::class,"search"]);