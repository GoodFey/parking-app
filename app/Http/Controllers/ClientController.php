<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;
use App\Models\Car;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function create()
    {
        return view('clients.create');
    }

    public function store(StoreRequest $request)
    {

        $data = $request->validated();

        $data['gender'] == "Мужчина" ? $data['gender'] = 1 : $data['gender'] = 0;
        $data['is_on_parking_now'] = isset ($data['is_on_parking_now']);

        Client::storeNewClient($data);

        Car::storeNewCar($data, Client::getLastClientId());

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
        $data['gender'] == "Мужчина" ? $data['gender'] = 1 : $data['gender'] = 0;
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
