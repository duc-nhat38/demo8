<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepositoryInterface;
use App\Repositories\HouseRepositoryInterface;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    protected $houseRepository;
    protected $postRepository;

    public function __construct(HouseRepositoryInterface $houseRepositoryInterface, PostRepositoryInterface $postRepositoryInterface)
    {
        $this->houseRepository = $houseRepositoryInterface;
        $this->postRepository = $postRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses = $this->houseRepository->all();
        $posts = $this->postRepository->getPostNews();

        return view('user.Index', compact(['houses', 'posts']));
    }

    public function search(Request $request)
    {
        $attribute = $request->all();
        if(isset($attribute['selectDistrict']) && isset($attribute['selectArea'])){
            $resultHouse = $this->houseRepository->searchHouseAll($attribute);
        }
        if(isset($attribute['selectDistrict']) && !isset($attribute['selectArea'])){
            $resultHouse = $this->houseRepository->searchByTypeAndDistrict($attribute);
        }
        if(!isset($attribute['selectDistrict']) && isset($attribute['selectArea'])){
            $resultHouse = $this->houseRepository->searchByTypeAndAddressAndArea($attribute);
        }
        if(!isset($attribute['selectDistrict']) && !isset($attribute['selectArea'])){
            $resultHouse = $this->houseRepository->searchByTypeAndAddress($attribute);
        }
        
        return view('user.SearchResult', compact('resultHouse'));
    }
}
