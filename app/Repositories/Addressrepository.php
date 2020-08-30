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

    public function update(array $array)
    {
        $address = Address::findOrFail($array['id']);
        $address->update(['address' => $array['address']]);

        return $address;
    }

    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        $address->addressDetails()->delete();

        return $address;
    }

    public function getAddressAll(){
        $addresses = Address::with('addressDetails')->get();

        return $addresses;
    }

    public function create($data){
        $address = Address::create([
            'address' => $data['address'],
        ]);

        return $address;
    }
}
