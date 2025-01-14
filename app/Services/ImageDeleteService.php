<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Client;
use App\Models\Image;
use App\Models\ImageCar;
use Illuminate\Support\Facades\Storage;

class ImageDeleteService
{
    /**
     * Create a new class instance.
     */
    public function deleteImage($currentCar)
    {

        ImageCar::deleteByImageId($currentCar->image_id);
        Car::deleteCar($currentCar->car_id);

        // Удаление картинки
        if ($currentCar->image_id != null) {
            $image = Image::getById($currentCar->image_id);

            // Удаляем основное изображение
            if (Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }

            // Удаляем превью изображение
            $previewPath = 'images/' . 'preview_' . basename($image->path);
            if (Storage::disk('public')->exists($previewPath)) {
                Storage::disk('public')->delete($previewPath);
            }


            Image::deleteById($currentCar->image_id);

        }
    }
}
