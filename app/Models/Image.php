<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Image extends Model
{
    protected $guarded = false;
    protected $table = 'images';

    public static function deleteById($imageId)
    {

        DB::table('images')
            ->where('id', $imageId)
            ->delete();
    }

    public static function getById($imageId)
    {
        return DB::table('images')
            ->where('id', $imageId)
            ->first();
    }


}
