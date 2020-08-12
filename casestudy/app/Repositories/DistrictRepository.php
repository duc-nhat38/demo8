<?php

namespace App\Repositories;

use App\Models\District;
use App\Repositories\DistrictRepositoryInterface;

class DistrictRepository implements DistrictRepositoryInterface
{
    public function all()
    {
        $district = District::all();

        return $district;
    }

    public function show($id)
    {
        $address = District::where('id', $id)->with('address')->get();

        return $address[0];
    }
    public function create(array $array)
    {
        foreach ($array[1] as $district) {
                $district = District::create(['address_id' => $array[0], 'district' => $district]);
        }

        return $array[1];
    }
}
