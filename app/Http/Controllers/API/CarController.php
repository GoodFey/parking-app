<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Car\StoreRequest;
use App\Http\Requests\Car\UpdateRequest;
use App\Models\Car;
use App\Models\Client;
use App\Models\ImageCar;
use App\Services\ImageDeleteService;
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
            return response()->json($validId->errors(), 400);
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
            return response()->json($validClientId->errors(), 400);
        }

        $data = $request->validated();

        $currentCar = Car::storeNewCar($data, $clientId);

        $data['hiddenImageId'] ? ImageCar::store($currentCar->id, $data['hiddenImageId']) : false;
        return response()->json(Car::getCarById($currentCar->id), 201);
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

        $data['hiddenImageId'] ? ImageCar::store($carId, $data['hiddenImageId']) : false;

        if ($validClientId->fails()) {
            return response()->json($validClientId->errors(), 400);
        } else {
            Car::updateCar($carId, $data);
            return response()->json(Car::getCarById($carId), 201);
        }

    }

    public static function delete($carId)
    {

        $validClientId = Validator::make(['id' => $carId], [
            'id' => 'required|numeric|exists:cars,id|digits_between:1,10'
        ],
            [
                'id.exists' => 'Car not found'
            ]);

        if ($validClientId->fails()) {
            return response()->json($validClientId->errors(), 400);
        }

        $currentCar = Car::getCarAndImageById($carId);
        $currentClient = Client::getClient($currentCar->client_id);

        $imageDeleteService = app(ImageDeleteService::class);
        $imageDeleteService->deleteImage($currentCar);

        // Проверка. Если у клиента не осталось машин, он тоже будет удален
        $allCarsCurrentClient = Car::getCarsOfClient($currentClient->id)->toArray();
        if ($allCarsCurrentClient == null) {
            Client::deleteClient($currentClient->id);
        }

        return response(status: 204);
    }

}
