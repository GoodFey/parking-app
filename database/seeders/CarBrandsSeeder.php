<?php

namespace Database\Seeders;

use App\Models\CarBrand;
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
        $models = [];
        foreach ($lines as $line) {
            $words = explode(";", $line);
            isset ($words[1]) ? $brands[$words[0]][] = $words[1] : null;


        }

        foreach ($brands as $brand => $models) {

            $currentBrand = CarBrand::create([
                'car_brand' => $brand,
            ]);

            foreach ($models as $model) {
                DB::table('cars_models')->insert([
                    'car_brand_id' => $currentBrand->id,
                    'car_model' => $model,
                ]);
            }
        }
//        foreach (array_unique($brands) as $brand) {
//            DB::table('cars_brands')
//                ->insert([
//                    'car_brand' => $brand,
//                    'car_model' => $models
//                ]);
//        }

    }

}
