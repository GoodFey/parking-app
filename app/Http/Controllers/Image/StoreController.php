<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\StoreRequest;
use App\Models\Image;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $image = $data['file'];


        $name = md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
        $previewName = 'preview_' . $name;
        $filePath = Storage::disk('public')->putFileAs('/images', $image, $name);

        $savedImage = Image::create([
            'title' => $name,
            'path' => $filePath,
            'url' => url('storage/' . $filePath),
            'preview_url' => url('storage/images/' . $previewName),
        ]);

        \Intervention\Image\Laravel\Facades\Image::read($image)
            ->resize(300, 300)
            ->save(storage_path('app/public/images/' . $previewName));

        return response()->json(['imageId' => $savedImage->id]);
    }
}
