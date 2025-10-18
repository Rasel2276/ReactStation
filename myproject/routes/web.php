<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\VendorAuthController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\VendorDashboardController;
use App\Http\Controllers\CustomerDashboardController;

/*
|--------------------------------------------------------------------------
| Admin Auth
|--------------------------------------------------------------------------
*/
Route::get('admin/login',[AdminAuthController::class,'showLoginForm'])->name('admin.login');
Route::post('admin/login',[AdminAuthController::class,'login']);
Route::post('admin/logout',[AdminAuthController::class,'logout'])->name('admin.logout');
Route::middleware('auth:admin')->group(function(){
    Route::get('admin/dashboard',[AdminDashboardController::class,'index'])->name('admin.dashboard');
});

/*
|--------------------------------------------------------------------------
| Vendor Auth
|--------------------------------------------------------------------------
*/
Route::get('vendor/register',[VendorAuthController::class,'showRegisterForm'])->name('vendor.register');
Route::post('vendor/register',[VendorAuthController::class,'register']);
Route::get('vendor/login',[VendorAuthController::class,'showLoginForm'])->name('vendor.login');
Route::post('vendor/login',[VendorAuthController::class,'login']);
Route::post('vendor/logout',[VendorAuthController::class,'logout'])->name('vendor.logout');
Route::middleware('auth:vendor')->group(function(){
    Route::get('vendor/dashboard',[VendorDashboardController::class,'index'])->name('vendor.dashboard');
});

/*
|--------------------------------------------------------------------------
| Customer Auth
|--------------------------------------------------------------------------
*/
Route::get('customer/register',[CustomerAuthController::class,'showRegisterForm'])->name('customer.register');
Route::post('customer/register',[CustomerAuthController::class,'register']);
Route::get('customer/login',[CustomerAuthController::class,'showLoginForm'])->name('customer.login');
Route::post('customer/login',[CustomerAuthController::class,'login']);
Route::post('customer/logout',[CustomerAuthController::class,'logout'])->name('customer.logout');
Route::middleware('auth:customer')->group(function(){
    Route::get('customer/dashboard',[CustomerDashboardController::class,'index'])->name('customer.dashboard');
});

