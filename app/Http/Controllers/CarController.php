<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Image\DeleteController;
use App\Http\Requests\Car\StoreRequest;
use App\Http\Requests\Car\UpdateRequest;

use App\Models\Car;
use App\Models\Client;
use App\Models\Image;
use App\Models\ImageCar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class CarController extends Controller
{
    public function test()
    {
        return view('cars.test');
    }

    public function index()
    {
        $carsClientsImages = Car::getCarsClientsImages()->paginate(10);



        return view('cars.index', compact('carsClientsImages'));
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

        $currentCar = Car::storeNewCar($data, $clientId);

        $data['hiddenImageId'] ? ImageCar::store($currentCar->id, $data['hiddenImageId']) : false;
        return redirect()->back();
    }

    public function delete($carId)
    {

        $currentCar = Car::getCarAndImageById($carId);

        $currentClient = Client::getClient($currentCar->client_id);
        ImageCar::deleteByImageId($currentCar->image_id);
        Car::deleteCar($currentCar->car_id);

        // Удаление картинки
        if ($currentCar->image_id != null) {
            $image = Image::getById($currentCar->image_id);

            // Удаляем основное изображение
            if (Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }

            // Удаляем превью изображение
            $previewPath = 'images/' . 'preview_' . basename($image->path);
            if (Storage::disk('public')->exists($previewPath)) {
                Storage::disk('public')->delete($previewPath);
            }


            Image::deleteById($currentCar->image_id);
            return redirect()->route('cars.index');
        }

        // Проверка. Если у клиента не осталось машин, он тоже будет удален
        $allCarsCurrentClient = Car::getCarsOfClient($currentClient->id)->toArray();
        if ($allCarsCurrentClient == null) {
            Client::deleteClient($currentClient->id);
        }

        return redirect()->back();
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

    public function deleteImage($imageId)
    {

        $image = Image::getById($imageId);

        // Удаляем основное изображение
        if (Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }

        // Удаляем превью изображение
        $previewPath = 'images/' . 'preview_' . basename($image->path);
        if (Storage::disk('public')->exists($previewPath)) {
            Storage::disk('public')->delete($previewPath);
        }

        ImageCar::deleteByImageId($imageId);
        Image::deleteById($imageId);
        return redirect()->back();
    }

}
