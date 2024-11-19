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

    static function storeNewCar($request, $lastCreatedClient)
    {
        DB::table('cars')
            ->insert([
                'brand' => $request['brand'],
                'model' => $request['model'],
                'color_of_carcass' => $request['color_of_carcass'],
                'gos_number' => $request['gos_number'],
                'is_on_parking_now' => 1,
                'client_id' => $lastCreatedClient->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
    }
}
