<?php

namespace App\Http\Controllers;

use App\Models\BannerImage;
use App\Repositories\BannerImageRepository;
use Illuminate\Http\Request;

class BannerImageController extends Controller
{   
    protected $bannerImageRepository;

    public function __construct(BannerImageRepository $bannerImageRepository)
    {
        $this->bannerImageRepository = $bannerImageRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = $this->bannerImageRepository->all();

        return response()->json($banners, 200);
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
     * @param  \App\Models\BannerImage  $bannerImage
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BannerImage  $bannerImage
     * @return \Illuminate\Http\Response
     */
    public function edit(BannerImage $bannerImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BannerImage  $bannerImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BannerImage $bannerImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BannerImage  $bannerImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(BannerImage $bannerImage)
    {
        //
    }
}
