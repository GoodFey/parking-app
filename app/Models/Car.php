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
        DB::table('cars')
            ->insert([
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
            ->where('client_id', $clientId)
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

    public static function test()
    {
        return'privet';
    }
}
