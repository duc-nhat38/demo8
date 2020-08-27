<?php

namespace App\Repositories;

use App\Models\BannerImage;
use App\Repositories\BannerRepositoryInterface;
use Illuminate\Support\Facades\File;

class BannerImageRepository implements BannerRepositoryInterface
{
    public function all()
    {
        $bannerImages = BannerImage::select('banner_images.*', 'users.name')
            ->join('users', 'banner_images.user_id', '=', 'users.id')
            ->orderBy('banner_images.show', 'desc')
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

        $bannerImage = BannerImage::findOrFail($array['id']);
        $bannerImage->title = $array['titleBanner'];
        $bannerImage->partner = $array['namePartner'];
        $bannerImage->expirationDate = $array['expirationDate'];
        $bannerImage->show = $array['show'];
        $bannerImage->user_id = $array['user_id'];
        if (isset($array['fileUpload'])) {
            $file_path = public_path('uploads/images/banners'.$bannerImage['imageAddress']);
            if (File::exists($file_path)) {
                File::delete($file_path);
            }
            $fileName = time() . rand() . '.' . $array['fileUpload']->getClientOriginalExtension();

            $bannerImage->imageAddress = $fileName;

            $array['fileUpload']->move(public_path("uploads/images/banners"), $fileName);
        }
        $bannerImage->save();

        return $bannerImage;
    }

    public function create(array $array)
    {
        $fileName = time() . rand() . '.' . $array['fileUpload']->getClientOriginalExtension();
        $bannerImage = BannerImage::create([
            'title' => $array['titleBanner'],
            'imageAddress' => $fileName,
            'partner' => $array['namePartner'],
            'expirationDate' => $array['expirationDate'],
            'show' => $array['show'],
            'user_id' => $array['user_id']
        ]);

        $array['fileUpload']->move(public_path("uploads/images/banners"), $fileName);

        return $bannerImage;
    }

    public function destroy($id)
    {
        BannerImage::where('id', $id)->delete();
    }

    public function bannerSlide()
    {
        $bannerImage = BannerImage::select('id', 'title', 'imageAddress')->where('show', 1)->get();

        return $bannerImage;
    }
}
