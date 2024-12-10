<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/cars-brands/{partQuery}', function($partQuery) {

    $currentBrands = DB::table('cars_brands')
        ->where('car_brand', 'like',$partQuery . '%')
        ->limit(10)
        ->pluck('car_brand');

    return response()->json($currentBrands);
});
