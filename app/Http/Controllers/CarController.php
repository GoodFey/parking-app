<?php

namespace App\Http\Controllers;


use App\Http\Requests\Car\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;
use App\Models\Car;


class CarController extends Controller
{
    public function update($carId, UpdateRequest $request)
    {
        $data = $request->validated();
        $data['is_on_parking_now'] = isset ($data['is_on_parking_now']);

        Car::updateCar($carId,$data);

        return redirect()->back();
    }
    public function store($clientId, StoreRequest $request)
    {
        dd($clientId, $request);
    }
}
