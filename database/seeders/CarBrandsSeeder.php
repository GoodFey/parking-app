<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CarBrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = Storage::disk('public')->get('cars_brands.csv');

        $lines = explode("\n", $file);
        $brands = [];
        foreach ($lines as $line) {
            $words = explode(";", $line);
            $brand = $words[0];
            $brands[] = $brand;

        }

        foreach (array_unique($brands) as $brand) {
            DB::table('cars_brands')
                ->insert([
                    'car_brand' => $brand,
                ]);
        }

    }

}
