<?php

namespace App\Http\Controllers;

use App\Http\Requests\District;
use App\Repositories\DistrictRepositoryInterface;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    protected $districtRepository;

    public function __construct(DistrictRepositoryInterface $districtRepositoryInterface)
    {
        $this->districtRepository = $districtRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $district = $this->districtRepository->all();

        return response()->json($district, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $address = $this->districtRepository->show($id);

        return response()->json($address, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(District $district)
    {
        $attribute = $district->all();
        $district = $this->districtRepository->update($attribute);

        return response()->json($district, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $district = $this->districtRepository->destroy($id);

        return response()->json($district, 200);
    }

    public function create(District $district){
        $value = $district->all();
        $district = $this->districtRepository->create($value);

        return response()->json($district, 200);
    }
}
