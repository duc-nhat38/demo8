<?php

namespace App\Repositories;

use App\Models\BannerImage;
use App\Repositories\BannerRepositoryInterface;

class BannerImageRepository implements BannerRepositoryInterface
{
    public function all()
    {
        $bannerImages = BannerImage::select('banner_images.*', 'users.name')
            ->join('users', 'banner_images.user_id', '=', 'users.id')
            ->get();

        return $bannerImages;
    }

    public function show($id)
    {
        $bannerImage = BannerImage::select('banner_images.*', 'users.name')
            ->join('users', 'banner_images.user_id', '=', 'users.id')
            ->where('banner_images.id', $id)
            ->get();

        return $bannerImage;
    }

    public function update(array $array)
    {
        $bannerImage = BannerImage::find($array['id']);

        $bannerImage->title = $array['title'];
        $bannerImage->imageAddress = $array['imageAddress'];
        $bannerImage->partner = $array['partner'];
        $bannerImage->expirationDate = $array['expirationDate'];
        $bannerImage->show = $array['show'];
        $bannerImage->user_id = $array['user_id'];
        $bannerImage->save();

        return $bannerImage;
    }

    public function create(array $array)
    {
        $bannerImage = BannerImage::create([
            'title' => $array['title'],
            'imageAddress' => $array['imageAddress'],
            'partner' => $array['partner'],
            'expirationDate' => $array['expirationDate'],
            'show' => $array['show'],
            'user_id' => $array['user_id']
        ]);

        return $bannerImage;
    }

    public function destroy($id)
    {
        BannerImage::where('id', $id)->delete();
    }
}
