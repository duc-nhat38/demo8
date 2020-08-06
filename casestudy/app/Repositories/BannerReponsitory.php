<?php

namespace App\Repositories;

use App\Models\BannerImage;

class BannerImageRepository
{
    public function all()
    {
        $bannerImages = BannerImage::all();

        return $bannerImages;
    }

    public function fullBannerImage()
    {
        $bannerImages = BannerImage::select('banner_images.*', 'employees.name')
        ->join('employees', 'banner_images.employee_id', '=', 'employees.id')
        ->get();

        return $bannerImages;
    }

    public function findById($bannerId)
    {
        return BannerImage::where('id', $bannerId)
            ->where('active', 1)
            ->with('BannerImage')
            ->firstOrFail();
    }

    public function findByBannerImageName($bannerName)
    {

        return BannerImage::where('name', 'like', '%' . $bannerName . '%')
            ->where('active', 1)
            ->with('BannerImage')
            ->get()
            ->map
            ->format();
    }

    public function lock($bannerId)
    {
        $bannerImage = BannerImage::where('id', $bannerId)->firstOrFail();

        $bannerImage->update(['locked' => 1]);

        return $bannerImage;
    }

    protected function format($BannerImage)
    {
        return [
            'BannerImage_id' => $BannerImage->id,
            'name' => $BannerImage->name,
            'created_by' => $BannerImage->BannerImage->email,
            'last_updated' => $BannerImage->updated_at->diffForHumans(),
        ];
    }
}