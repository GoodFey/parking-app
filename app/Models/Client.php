<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $table = 'clients';

    static function getClient($clientId)
    {
        $client = DB::table('clients')
            ->where('id', $clientId)
            ->first();
        return $client;
    }

    static function getAllClientsAndCars()
    {
        $clientsAndCars = DB::table('clients')
            ->join('cars', 'clients.id', '=', 'cars.client_id');


        return $clientsAndCars;
    }

    static function getLastClientId()
    {
        $lastCreatedClient = DB::table('clients')
            ->orderBy('id', 'desc')
            ->first();
        return $lastCreatedClient->id;
    }

    static function storeNewClient($data)
    {
        DB::table('clients')
            ->insert([
                'fio' => $data['fio'],
                'gender' => $data['gender'],
                'phone_number' => $data['phone_number'],
                'address' => $data['address'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

    }

    static function updateClient($clientId, $data)
    {
        DB::table('clients')
            ->where('id', $clientId)
            ->update([
                'fio' => $data['fio'],
                'gender' => $data['gender'],
                'phone_number' => $data['phone_number'],
                'address' => $data['address'],
                'updated_at' => Carbon::now()
            ]);
    }
    static function deleteClient($clientId)
    {
        DB::table('clients')
            ->where('id', $clientId)
            ->delete();
    }

}
