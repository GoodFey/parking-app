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
        ->pluck('car_brand');

    return response()->json($currentBrands);
});

Route::get('/cars-models/{brand}', function($brand) {

    $currentModels = DB::table('cars_brands')
        ->join('cars_models', 'cars_brands.id', '=', 'cars_models.car_brand_id')
        ->where('car_brand', 'like', $brand)
        ->pluck('car_model');

    return response()->json($currentModels);
});

Route::get('cars', function() {
   $cars = \App\Models\Car::getAllCars()->get();
   return response()->json($cars);
});
