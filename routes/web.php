<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
Route::get('/', function () {
    return view('welcome');
});
Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
Route::match(['get', 'post'], 'dashboard',[AdminController::class,'dashboard']);
Route::match(['get', 'post'], 'login',[AdminController::class,'login']);
Route::match(['get', 'post'], 'register',[AdminController::class,'register']);
});