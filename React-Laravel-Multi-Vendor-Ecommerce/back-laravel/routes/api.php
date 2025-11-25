<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);



Route::middleware(['role:admin'])->group(function(){
    Route::get('/admin/dashboard', function(){ return "Admin Dashboard"; });
});

Route::middleware(['role:vendor'])->group(function(){
    Route::get('/vendor/dashboard', function(){ return "Vendor Dashboard"; });
});

Route::middleware(['role:customer'])->group(function(){
    Route::get('/customer/dashboard', function(){ return "Customer Dashboard"; });
});


