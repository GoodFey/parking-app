<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Car\StoreRequest;
use App\Http\Requests\Car\UpdateRequest;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public static function index()
    {
        $cars = Car::getAllCars()->get();
        return response()->json($cars);
    }

    public static function show($id)
    {

        $validId = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:cars,id|digits_between:1,10'
        ], [
            'exists' => 'Car not found'
        ]);

        if ($validId->fails()) {
            return response()->json($validId->errors(), 404);
        }
        $car = Car::getCarById($id);
        return response()->json($car);
    }


    public static function store(StoreRequest $request, $clientId)
    {
        $validClientId = Validator::make(['id' => $clientId], [
            'id' => 'required|numeric|exists:clients,id|digits_between:1,10'
        ],
            [
                'id.exists' => 'Client not found'
            ]);

        if ($validClientId->fails()) {
            return response()->json($validClientId->errors(), 404);
        }

        $data = $request->validated();
        Car::storeNewCar($data, $clientId);

        return response()->json(Car::getCarsOfClient($clientId));
    }

    public static function update(UpdateRequest $request, $carId)
    {

        $validClientId = Validator::make(['id' => $carId], [
            'id' => 'required|numeric|exists:cars,id|digits_between:1,10'
        ],
            [
                'id.exists' => 'Client not found'
            ]);

        $data = $request->validated();

        if ($validClientId->fails()) {
            return response()->json($validClientId->errors(), 404);
        } else {
            Car::updateCar($carId, $data);
            return response()->json(Car::getCarById($carId));
        }

    }
    public static function delete($carId){

        $validClientId = Validator::make(['id' => $carId], [
            'id' => 'required|numeric|exists:cars,id|digits_between:1,10'
        ],
            [
                'id.exists' => 'Car not found'
            ]);

        if ($validClientId->fails()) {
            return response()->json($validClientId->errors(), 404);
        }

        Car::deleteCar($carId);
        return response()->json("Car with id - {$carId} was deleted");
    }

}
