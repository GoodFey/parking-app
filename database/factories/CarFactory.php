<?php

namespace Database\Factories;


use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => fake()->name,
            'model' => fake()->streetName,
            'color_of_carcass' => fake()->colorName,
            'gos_number' => self::createGosNumber(),
            'is_on_parking_now' => fake()->boolean,
            'client_id' => Client::factory()->create()
        ];
    }

    public static function createGosNumber()
    {
        $pattern = "/^[АВЕКМНОРСТУХABEKMHOPCTYX]{1}[1-9]{3}[АВЕКМНОРСТУХABEKMHOPCTYX]{2}[1-9]{2}?/u";
        do {
            $gosNum = strtoupper(fake()->bothify("?###??##"));
        } while (!preg_match($pattern, $gosNum));
        return $gosNum;
    }
    public function run()
    {
        $cars = [
            ['name' => 'Car 1', 'image' => 'car1.jpg'],
            ['name' => 'Car 2', 'image' => 'car2.png'],
            ['name' => 'Car 3', 'image' => 'car3.gif'], // Пример с неподдерживаемым форматом
        ];

        foreach ($cars as $carData) {
            $imagePath = $carData['image'];

            // Проверяем формат изображения
            $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
            if (!in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
                continue; // Пропускаем неподдерживаемые форматы
            }

            // Загружаем и обрабатываем изображение
            $sourcePath = public_path("images/source/$imagePath"); // Исходное изображение
            $destinationPath = "images/cars/" . uniqid() . ".$extension"; // Куда сохраняем

            if (file_exists($sourcePath)) {
                $image = Image::make($sourcePath)
                    ->resize(300, 300, function ($constraint) {
                        $constraint->aspectRatio(); // Сохраняем пропорции
                        $constraint->upsize(); // Не увеличиваем маленькие изображения
                    })
                    ->encode($extension);

                // Сохраняем обработанное изображение
                Storage::disk('public')->put($destinationPath, $image);

                // Создаём запись в БД
                Car::create([
                    'name' => $carData['name'],
                    'image_path' => $destinationPath,
                ]);
            }
        }
    }
}
