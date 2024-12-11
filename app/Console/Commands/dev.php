<?php

namespace App\Console\Commands;

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

//        $currentModels = DB::table('cars_brands')
//        ->join('cars_models', 'cars_brands.id', '=', 'cars_models.car_brand_id')
//        ->where('car_brand', 'like', $brand)
//        ->limit(10)
//        ->pluck('car_model');


//        dd($currentModels);
    }
}
