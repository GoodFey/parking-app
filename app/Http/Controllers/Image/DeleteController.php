<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\StoreRequest;
use App\Models\Image;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function __invoke($imageId)
    {

        $image = Image::getById($imageId);

        // Удаляем основное изображение
        if (Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }

        // Удаляем превью изображение
        $previewPath = 'images/' . 'preview_' . basename($image->path);
        if (Storage::disk('public')->exists($previewPath)) {
            Storage::disk('public')->delete($previewPath);
        }

        Image::deleteById($imageId);
        return response()->json('delete success', 200);
    }
}
