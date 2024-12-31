<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;
use App\Models\Car;
use App\Models\Client;
use App\Models\ImageCar;

class ClientController extends Controller
{
    public function create()
    {
        return view('clients.create');
    }

    public function store(StoreRequest $request)
    {

        $data = $request->validated();

        Client::storeNewClient($data);

        $currentCar = Car::storeNewCar($data, Client::getLastClientId());

        $data['hiddenImageId'] ? ImageCar::store($currentCar->id, $data['hiddenImageId']) : false;

        return redirect()->route('cars.index');
    }

    public function show($clientId)
    {
        $client = Client::getClient($clientId);

        return view('clients.show', compact('client'));
    }

    public function edit($clientId)
    {

        $client = Client::getClient($clientId);
        $cars = Car::getCarsOfClient($clientId);


        return view('clients.edit', compact('client', 'cars'));
    }

    public function update($clientId, UpdateRequest $request)
    {
        $data = $request->validated();

        Client::updateClient($clientId, $data);
        return redirect()->route('clients.edit', $clientId);
    }

    public function delete($clientId)
    {

        Car::deleteCarsThisClient($clientId);
        Client::deleteClient($clientId);

        return redirect()->route('cars.index');
    }


}
