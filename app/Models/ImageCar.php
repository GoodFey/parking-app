<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ImageCar extends Model
{
    protected $guarded = false;
    protected $table = 'images_cars';

    public static function store($carId, $imageId)
    {
        DB::table('images_cars')->insert([
            'car_id' => $carId,
            'image_id' => $imageId
        ]);
    }

    public static function deleteByImageId($imageId)
    {
        DB::table('images_cars')
            ->where('image_id', $imageId)
            ->delete();
    }
}
