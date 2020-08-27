<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Repositories\AddressRepositoryInterface;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepositoryInterface)
    {
        $this->addressRepository = $addressRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = $this->addressRepository->all();

        return response()->json($address, 200);
    }

    public function update(Request $request)
    {
        $attribute = $request->all();
        $address = $this->addressRepository->update($attribute);

        return response()->json($address, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $id = $request->id;
       $address = $this->addressRepository->destroy($id);

       return response()->json($address, 200);
    }
    public function show(Request $request){
        $id = $request->id;
        $districts = $this->addressRepository->show($id);

        return response()->json($districts, 200);
    }

    public function getAddressAll(){
        $addresses = $this->addressRepository->getAddressAll();

        return response()->json($addresses, 200);
    }
}
