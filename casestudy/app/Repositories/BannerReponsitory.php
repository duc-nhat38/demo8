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

}