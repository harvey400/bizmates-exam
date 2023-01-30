<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\WeatherController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'location'], function(){
    Route::get('',              [LocationController::class,'index']);
    Route::get('nearby/{city}', [LocationController::class,'nearby']);
    Route::get('ll/{city}',     [LocationController::class,'ll']);
});

Route::group(['prefix'=>'weather'], function(){
    Route::get('', [WeatherController::class,'index']);
});
