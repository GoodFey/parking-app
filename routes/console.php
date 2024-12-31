<?php

use App\Models\Car;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('getAllCars', function () {
    $cars = Car::getAllCars()->get()->toArray();
    foreach ($cars as $car) {
        foreach ($car as $key => $value) {
            $this->info($key . ' - ' . $value);
        }
        $this->newLine();
    }
});

