<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Repositories\HouseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HouseController extends Controller
{
    protected $houseRepository;

    public function __construct(HouseRepositoryInterface $houseRepositoryInterface)
    {
        $this->houseRepository = $houseRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses = $this->houseRepository->all();

        return response()->json($houses, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attribute = $request->all();
        if($request->hasFile('inputFile')){
            $attribute['inputFile'] = $request->inputFile;
            $house = $this->houseRepository->create($attribute);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        
        $productKey = 'product_'.$id;
        if(!Session::has($productKey)){
            $view = $this->houseRepository->view($id);
            Session::put($productKey, 1);
        }
        $house = $this->houseRepository->show($id);

        return view('user.HouseInfo', compact('house'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $attribute = $request->all();
        $house = $this->houseRepository->update($attribute);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function destroy(House $house)
    {
        //
    }

    public function getPhotos(Request $request)
    {
        $id = $request->id;
        $photos = $this->houseRepository->getPhotos($id);

        return response()->json($photos, 200);
    }

    public function getComments(Request $request)
    {
        $id = $request->id;
        $comments = $this->houseRepository->getComments($id);

        return response()->json($comments, 200);
    }

    public function rate(Request $request)
    {
        $attribute = $request->all();
        $vote = $this->houseRepository->rate($attribute);

        return response()->json($vote, 200);
    }

    public function getMyVote(Request $request)
    {
        $attribute = $request->all();
        $vote = $this->houseRepository->getMyVote($attribute);

        return response()->json($vote, 200);
    }
    public function getVotes(Request $request)
    {
        $house_id = $request->house_id;
        $votes = $this->houseRepository->getVotes($house_id);

        return response()->json($votes, 200);
    }

    public function comment(Request $request){
        $attribute = $attribute = $request->all();
        $comment = $this->houseRepository->comment($attribute);

        return response()->json($comment, 200);
    }
    public function delComment(Request $request){
        $id = $request->id;
        $comment = $this->houseRepository->delComment($id);

        return response()->json($comment, 200);
    }

    public function editComment(Request $request){
        $attribute = $attribute = $request->all();
        $comment = $this->houseRepository->editComment($attribute);

        return response()->json($comment, 200);
    }
    public function businessHouse(Request $request){
        $id = $request->id;
        $businessHouse = $this->houseRepository->businessHouse($id);

        return view('user.BusinessHouse', compact('businessHouse'));
    }

    public function getAddressHouse(Request $request){
        $id = $request->id;
        $addressHouse = $this->houseRepository->getAddressHouse($id);

        return view('user.AddressHouse', compact('addressHouse'));
    }

    public function getDistrictHouse(Request $request){
        $id = $request->id;
        $districtHouse = $this->houseRepository->getDistrictHouse($id);

        return view('user.DistrictHouse', compact('districtHouse'));
    }

    public function houseDetail(Request $request){
        $id = $request->id;
        $house = $this->houseRepository->show($id);

        return response()->json($house, 200);
    }

    public function houseDelete(Request $request){
        $id = $request->id;
        $result = $this->houseRepository->houseDelete($id);

        return response()->json($result, 200);
    }
}
