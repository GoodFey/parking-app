<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreRequest;
use App\Models\Car;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index()
    {
        $clientsAndCars = Client::getAllClientsAndCars()->paginate(10);
        return view('clients.index', compact('clientsAndCars'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(StoreRequest $request)
    {

        $data = $request->validated();

        $data['gender'] == "Мужчина" ? $data['gender'] = 1 : $data['gender'] = 0;

        Client::storeNewClient($data);

        Car::storeNewCar($data, Client::getLastCreatedClient());

        return redirect()->route('clients.index');
    }

    public function show($clientId)
    {
        $client = Client::showOneClient($clientId);

        return view('clients.show', compact('client'));
    }

    public function edit($clientId)
    {
        $client = Client::showOneCLient($clientId);

        return view('clients.edit', compact('client'));
    }

    public function update()
    {
        return "";
    }
}
