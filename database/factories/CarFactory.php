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
}
