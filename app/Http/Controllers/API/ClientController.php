<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\UpdateRequest;
use App\Models\Car;
use App\Models\Client;
use App\Services\ImageDeleteService;


class ClientController extends Controller
{
    public function update($clientId, UpdateRequest $request)
    {
        $data = $request->validated();

        Client::updateClient($clientId, $data);

        return response()->json();
    }
    public function delete($clientId)
    {

        $cars = Car::getCarsOfClient($clientId);

        foreach ($cars as $currentCar) {
            $imageDeleteService = app(ImageDeleteService::class);
            $imageDeleteService->deleteImage($currentCar);
            Car::deleteCar($currentCar->id);
        }

        Client::deleteClient($clientId);

        return response()->json();
    }

}
