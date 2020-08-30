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
        $address = District::with('address:id,address')->where('id', $id)->get();
        
        return $address[0];
    }
    public function update(array $array)
    {
        $district = District::findOrFail($array['id']);
        $district->update([
            'district' => $array['district'],
            'address_id' => $array['address_id'],
            ]);

        return $district;
    }
    public function destroy($id)
    {
        $district = District::findOrFail($id);
        $district->delete();

        return $district;
    }

    public function create(array $array){
        
        return District::create([
            'district' => $array['district'],
            'address_id' => $array['address_id'],
        ]);
    }
}
