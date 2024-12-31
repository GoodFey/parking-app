<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Car extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $table = 'cars';

    static function storeNewCar($data, $currentClientId)
    {
        return Car::create([
            'brand' => $data['brand'],
            'model' => $data['model'],
            'color_of_carcass' => $data['color_of_carcass'],
            'gos_number' => $data['gos_number'],
            'is_on_parking_now' => $data['is_on_parking_now'],
            'client_id' => $currentClientId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }

    static function getCarsOfClient($clientId)
    {
        return DB::table('cars')
            ->join('clients', 'cars.client_id', '=', 'clients.id')
            ->leftJoin('images_cars', 'cars.id', '=', 'images_cars.car_id')
            ->leftJoin('images', 'images_cars.image_id', '=', 'images.id')
            ->where('client_id', $clientId)
            ->select('cars.id as car_id', 'images.id as image_id', 'cars.*', 'clients.*', 'images.*')
            ->get();
    }

    static function updateCar($carId, $data)
    {

        DB::table('cars')
            ->where('id', $carId)
            ->update([
                'brand' => $data['brand'],
                'model' => $data['model'],
                'color_of_carcass' => $data['color_of_carcass'],
                'gos_number' => $data['gos_number'],
                'is_on_parking_now' => $data['is_on_parking_now'],
                'updated_at' => Carbon::now()
            ]);


    }

    public static function deleteCarsThisClient($clientId)
    {
        DB::table('cars')
            ->where('client_id', $clientId)
            ->delete();
    }

    public static function deleteCar($carId)
    {
        DB::table('cars')
            ->where('id', $carId)
            ->delete();
    }

    public static function getAllCars()
    {
        return DB::table('cars')
            ->orderBy('id', 'desc');
    }

    public static function getCarsClientsImages()
    {

        return DB::table('cars')
            ->join('clients', 'cars.client_id', '=', 'clients.id')
            ->leftJoin('images_cars', 'cars.id', '=', 'images_cars.car_id')
            ->leftJoin('images', 'images_cars.image_id', '=', 'images.id')
            ->select('cars.id as car_id', 'cars.*', 'clients.*', 'images.*')
            ->orderBy('cars.id', 'desc');

    }

    public static function getCarsOnParking()
    {
        return DB::table('cars')
            ->where('is_on_parking_now', 1)
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public static function changeParkingStatus($carId, $status)
    {
        DB::table('cars')
            ->where('id', $carId)
            ->update([
                'is_on_parking_now' => $status,
                'updated_at' => Carbon::now()
            ]);
    }

    public static function getCarById($carId)
    {
        return DB::table('cars')
            ->where('id', $carId)
            ->first();
    }


    public static function getCarAndImageById($carId)
    {

        return DB::table('cars')
            ->join('clients', 'cars.client_id', '=', 'clients.id')
            ->leftJoin('images_cars', 'cars.id', '=', 'images_cars.car_id')
            ->leftJoin('images', 'images_cars.image_id', '=', 'images.id')
            ->select('cars.id as car_id', 'images.id as image_id', 'cars.*', 'clients.*', 'images.*')
            ->where('cars.id', $carId)
            ->first();
    }
}
