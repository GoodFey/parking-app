<?php

namespace App\Console\Commands;

use App\Models\Car;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



class dev extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $files = $file = Storage::disk('public')->allFiles('images/cars');

        foreach ($files as $file) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            if (!in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
                continue;
            }

            if (file_exists($file)) {
                dump('123');






                $image = Image::make($file)
                    ->resize(300, 300, function ($constraint) {
                        $constraint->aspectRatio(); // Сохраняем пропорции
                        $constraint->upsize(); // Не увеличиваем маленькие изображения
                    })
                    ->encode($extension);

                //         Сохраняем обработанное изображение
                Storage::disk('public')->put('images/cars', $image);
            }
        }


//
//            // Создаём запись в БД
//            Car::create([
//                'name' => $carData['name'],
//                'image_path' => $destinationPath,
//            ]);
    }

}
