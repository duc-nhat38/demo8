<?php

namespace App\Http\Controllers;

use App\Models\BannerImage;
use App\Repositories\BannerRepositoryInterface;
use Illuminate\Http\Request;

class BannerImageController extends Controller
{   
    protected $bannerRepository;

    public function __construct(BannerRepositoryInterface $bannerRepositoryInterface)
    {
        $this->bannerRepository = $bannerRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = $this->bannerRepository->all();

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
        $attribute = $request->all();
        $banner = $this->bannerRepository->create($attribute);

        return response()->json($banner, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BannerImage  $bannerImage
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $banner = $this->bannerRepository->show($id);

        return response()->json($banner, 200);
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
    public function update(Request $request)
    {
        $attribute = $request->all();
        $banner = $this->bannerRepository->update($attribute);

        return response()->json($banner);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BannerImage  $bannerImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $banner = $this->bannerRepository->destroy($id);

        return response()->json($banner);
    }
}
