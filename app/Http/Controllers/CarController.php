<?php

namespace App\Http\Controllers;


use App\Http\Requests\Car\StoreRequest;
use App\Http\Requests\Car\UpdateRequest;

use App\Models\Car;
use App\Models\Client;
use Illuminate\Support\Facades\DB;


class CarController extends Controller
{
    public function test(){
        return view('clients.index');
    }
    public function index()
    {
        $cars = Car::getAllCars()->paginate(10);
        return view('cars.index', compact('cars'));
    }

    public function update($carId, UpdateRequest $request)
    {
        $data = $request->validated();

//        $data['is_on_parking_now'] = isset ($data['is_on_parking_now']);

        Car::updateCar($carId, $data);

        return redirect()->back();
    }

    public function store($clientId, StoreRequest $request)
    {
        $data = $request->validated();



        Car::storeNewCar($data, $clientId);
        return redirect()->back();
    }

    public function delete($carId)
    {
        $currentCar = Car::getCarById($carId);
        $currentClient = Client::getClient($currentCar->client_id);
        Car::deleteCar($carId);
        $allCarsCurrentClient = Car::getCarsOfClient($currentClient->id)->toArray();

        if($allCarsCurrentClient == null)
        {
            Client::deleteClient($currentClient->id);
        }

        return redirect()->route('cars.index');
    }

    public function onParking($clientId)
    {
        $clients = Client::getAllClients();
        $carsOnParking = Car::getCarsOnParking();
        if ($clientId != 0) {
            $selectedClient = Client::getClient($clientId);
            $selectedClientCars = Car::getCarsOfClient($clientId);
        } else {
            $selectedClient = null;
            $selectedClientCars = null;
        }
        return view('cars.onParking', compact('carsOnParking', 'clients', 'selectedClient', 'selectedClientCars'));
    }

    public function removeFromParking($carId)
    {
        Car::changeParkingStatus($carId, 0);
        return redirect()->back();
    }

    public function updateParkingStatus($carId)
    {
        Car::changeParkingStatus($carId, 1);
        return redirect()->back();
    }

}
