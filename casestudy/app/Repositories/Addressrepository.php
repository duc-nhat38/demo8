<?php

namespace App\Repositories;

use App\Models\Address;
use App\Repositories\AddressRepositoryInterface;

class AddressRepository implements AddressRepositoryInterface
{
    public function all()
    {
        $address = Address::all();

        return $address;
    }

    public function show($id)
    {
        $district = Address::where('id', $id)->with('addressDetails')->get();

        return $district[0];
    }

    public function create(array $array)
    {
        $address = Address::create(['address' => $array['address']]);

        return $address;
    }
}
