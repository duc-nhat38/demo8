<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\AddressDetails;
use App\Models\BusinessType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user() != null && (Auth::user()->isAdmin == 1)){

            return redirect()->route('dashboard');
        }

        $businessType = BusinessType::all();

        return view('user.Index', compact(['businessType']));
    }

    function getListAddress(){
        $listAddress = Address::all();
        return response()->json($listAddress , 200);
    }


    
    function getListAddressDetails(){
        $listAddressDetails = AddressDetails::all();
        return response()->json($listAddressDetails , 200);
    }

    function getAddressDetails($id){
        $listAddressDetails = AddressDetails::where('address_id',$id)->get();
        return response()->json($listAddressDetails , 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
