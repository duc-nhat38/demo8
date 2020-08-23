<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\HomeInformation;
use App\Models\HomePhoto;
use Illuminate\Support\Facades\DB;
use App\Models\House;
use App\Models\Vote;
use App\Repositories\HouseRepositoryInterface;

class HouseRepository implements HouseRepositoryInterface
{
    public function all()
    {
        $houses = House::select(
            'houses.id',
            'houses.business_type_id',
            'houses.district_id',
            'users.name',
            'houses.user_id',
            'districts.district',
            'districts.address_id',
            'addresses.address',
            'home_information.area',
            'home_information.title',
            'business_types.typeName AS businessName',
            'houses.price',
            'houses.view',
            'houses.expired',
            'houses.created_at'
        )->join('users', 'users.id', '=', 'houses.user_id')
            ->join('districts', 'districts.id', '=', 'houses.district_id')
            ->join('addresses', 'districts.address_id', '=', 'addresses.id')
            ->join('home_information', 'home_information.house_id', '=', 'houses.id')
            ->join('business_types', 'business_types.id', '=', 'houses.business_type_id')
            ->orderBy('houses.created_at', 'desc')
            ->paginate(12);
        foreach ($houses as $house) {
            $photo = HomePhoto::where('house_id', $house['id'])->first();
            $house->photo = $photo['photoAddress'];
            $house['day_create'] = $house['created_at']->format('H:m d-m-Y');
        }

        return $houses;
    }
    public function create(array $array)
    {
        $house = House::create([
            'user_id' => $array['user_id'],
            'business_type_id' => $array['inputBusiness'],
            'price' => $array['inputPrice'],
            'district_id' => $array['inputDistrict'],
        ]);
        $houseInfo = HomeInformation::create([
            'area' => $array['inputArea'],
            'title' => $array['inputTitle'],
            'description' => $array['inputDescription'],
            'house_id' =>  $house->id,
        ]);

        foreach ($array['inputFile'] as $photo) {
            $fileName = time() . rand() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads'), $fileName);
            $photo = HomePhoto::create([
                'photoAddress' => $fileName,
                'house_id' =>  $house->id,
            ]);
        }

        return true;
    }

    public function show($id)
    {
        $house = House::select(
            'houses.id',
            'houses.business_type_id',
            'houses.district_id',
            'users.name',
            'houses.user_id',
            'districts.district',
            'districts.address_id',
            'addresses.address',
            'home_information.area',
            'home_information.title',
            'home_information.description',
            'business_types.typeName AS businessName',
            'houses.price',
            'houses.view',
            'houses.expired',
            'houses.created_at'
        )->join('users', 'users.id', '=', 'houses.user_id')
            ->join('districts', 'districts.id', '=', 'houses.district_id')
            ->join('addresses', 'districts.address_id', '=', 'addresses.id')
            ->join('home_information', 'home_information.house_id', '=', 'houses.id')
            ->join('business_types', 'business_types.id', '=', 'houses.business_type_id')
            ->where('houses.id', $id)
            ->first();
            $house['photos'] = HomePhoto::where('house_id', $house['id'])->get();
            $house['day_create'] = $house['created_at']->format('H:m d-m-Y');
            
        return $house;
    }

    public function getPhotos($id)
    {
        $photos = HomePhoto::where('house_id', $id)->get();

        return $photos;
    }



    public function rate(array $array)
    {
        $vote = Vote::updateOrCreate([
            'user_id' => $array['user_id'],
            'house_id' => $array['house_id']
        ], [
            'point' => $array['rate']
        ]);

        return $vote;
    }

    public function getMyVote(array $array)
    {
        $vote = Vote::where('user_id', $array['user_id'])->where('house_id', $array['house_id'])->get();
        if (count($vote) != 0) {
            return $vote[0];
        } else {
            return false;
        }
    }

    public function getVotes($house_id)
    {
        $vote = DB::table('votes')
            ->select(DB::raw('count(id) as count, sum(point) as total'))->where('house_id', $house_id)->get();

        return $vote[0];
    }

    public function comment(array $array)
    {
        $comment = Comment::create([
            'user_id' => $array['user_id'],
            'house_id' => $array['house_id'],
            'content' => $array['content']
        ]);

        return $comment;
    }

    public function getComments($id)
    {
        $comments = Comment::select(
            'comments.*',
            'users.name',
            'user_information.avatar'
        )
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->join('user_information', 'user_information.user_id', '=', 'users.id')
            ->where('comments.house_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
            foreach($comments as $comment){
                $comment['day_create'] = $comment['created_at']->format('H:m d-m-Y');
            }

        return $comments;
    }
    public function delComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return true;
    }

    public function editComment(array $array)
    {
        $comment = Comment::findOrFail($array['id']);
        $comment->update([
            'content' => $array['content']
        ]);

        return $comment;
    }
    public function view($id)
    {
        $house = House::where('id', $id)->increment('view');

        return $house;
    }

    public function businessHouse($id)
    {
        $businessHouse = House::select(
            'houses.id',
            'houses.business_type_id',
            'houses.district_id',
            'users.name',
            'houses.user_id',
            'districts.district',
            'districts.address_id',
            'addresses.address',
            'home_information.area',
            'home_information.title',
            'business_types.typeName AS businessName',
            'houses.price',
            'houses.view',
            'houses.expired',
            'houses.created_at'
        )->join('users', 'users.id', '=', 'houses.user_id')
            ->join('districts', 'districts.id', '=', 'houses.district_id')
            ->join('addresses', 'districts.address_id', '=', 'addresses.id')
            ->join('home_information', 'home_information.house_id', '=', 'houses.id')
            ->join('business_types', 'business_types.id', '=', 'houses.business_type_id')
            ->where('houses.business_type_id', $id)
            ->orderBy('houses.created_at', 'desc')
            ->paginate(12);
        foreach ($businessHouse as $house) {
            $photo = HomePhoto::where('house_id', $house['id'])->first();
            $house->photo = $photo['photoAddress'];
            $house['day_create'] = $house['created_at']->format('H:m d-m-Y');
        }

        return $businessHouse;
    }

    public function searchHouseAll($data)
    {
        switch ($data['selectArea']) {
            case '1':
                $start = 0;
                $end = 20;
                break;
            case '2':
                $start = 20;
                $end = 30;
                break;
            case '3':
                $start = 30;
                $end = 40;
                break;
            case '4':
                $start = 40;
                $end = 50;
                break;
            case '5':
                $start = 50;
                $end = 100;
                break;
            case '6':
                $start = 100;
                $end = 500;
                break;
        }
        $searchHouseAll = House::select(
            'houses.id',
            'houses.business_type_id',
            'houses.district_id',
            'users.name',
            'houses.user_id',
            'districts.district',
            'districts.address_id',
            'addresses.address',
            'home_information.area',
            'home_information.title',
            'business_types.typeName AS businessName',
            'houses.price',
            'houses.view',
            'houses.expired',
            'houses.created_at'
        )->join('users', 'users.id', '=', 'houses.user_id')
            ->join('districts', 'districts.id', '=', 'houses.district_id')
            ->join('addresses', 'districts.address_id', '=', 'addresses.id')
            ->join('home_information', 'home_information.house_id', '=', 'houses.id')
            ->join('business_types', 'business_types.id', '=', 'houses.business_type_id')
            ->where('houses.business_type_id', $data['selectBusiness'])
            ->where('houses.district_id', $data['selectDistrict'])
            ->whereBetween('home_information.area', [$start, $end])
            ->orderBy('houses.created_at', 'desc')
            ->paginate(12);
        foreach ($searchHouseAll as $house) {
            $photo = HomePhoto::where('house_id', $house['id'])->first();
            $house->photo = $photo['photoAddress'];
            $house['day_create'] = $house['created_at']->format('H:m d-m-Y');
        }

        return $searchHouseAll;
    }

    public function searchByTypeAndAddress($data)
    {

        $searchHouseAll = House::select(
            'houses.id',
            'houses.business_type_id',
            'houses.district_id',
            'users.name',
            'houses.user_id',
            'districts.district',
            'districts.address_id',
            'addresses.address',
            'home_information.area',
            'home_information.title',
            'business_types.typeName AS businessName',
            'houses.price',
            'houses.view',
            'houses.expired',
            'houses.created_at'
        )->join('users', 'users.id', '=', 'houses.user_id')
            ->join('districts', 'districts.id', '=', 'houses.district_id')
            ->join('addresses', 'districts.address_id', '=', 'addresses.id')
            ->join('home_information', 'home_information.house_id', '=', 'houses.id')
            ->join('business_types', 'business_types.id', '=', 'houses.business_type_id')
            ->where('houses.business_type_id', $data['selectBusiness'])
            ->where('districts.address_id', $data['selectAddress'])
            ->orderBy('houses.created_at', 'desc')
            ->paginate(12);
        foreach ($searchHouseAll as $house) {
            $photo = HomePhoto::where('house_id', $house['id'])->first();
            $house->photo = $photo['photoAddress'];
            $house['day_create'] = $house['created_at']->format('H:m d-m-Y');
        }

        return $searchHouseAll;
    }

    public function searchByTypeAndAddressAndArea($data)
    {
        switch ($data['selectArea']) {
            case '1':
                $start = 0;
                $end = 20;
                break;
            case '2':
                $start = 20;
                $end = 30;
                break;
            case '3':
                $start = 30;
                $end = 40;
                break;
            case '4':
                $start = 40;
                $end = 50;
                break;
            case '5':
                $start = 50;
                $end = 100;
                break;
            case '6':
                $start = 100;
                $end = 500;
                break;
        }
        $searchByTypeAndAddressAndArea = House::select(
            'houses.id',
            'houses.business_type_id',
            'houses.district_id',
            'users.name',
            'houses.user_id',
            'districts.district',
            'districts.address_id',
            'addresses.address',
            'home_information.area',
            'home_information.title',
            'business_types.typeName AS businessName',
            'houses.price',
            'houses.view',
            'houses.expired',
            'houses.created_at'
        )->join('users', 'users.id', '=', 'houses.user_id')
            ->join('districts', 'districts.id', '=', 'houses.district_id')
            ->join('addresses', 'districts.address_id', '=', 'addresses.id')
            ->join('home_information', 'home_information.house_id', '=', 'houses.id')
            ->join('business_types', 'business_types.id', '=', 'houses.business_type_id')
            ->where('houses.business_type_id', $data['selectBusiness'])
            ->where('districts.address_id', $data['selectAddress'])
            ->whereBetween('home_information.area', [$start, $end])
            ->orderBy('houses.created_at', 'desc')
            ->paginate(12);
        foreach ($searchByTypeAndAddressAndArea as $house) {
            $photo = HomePhoto::where('house_id', $house['id'])->first();
            $house->photo = $photo['photoAddress'];
            $house['day_create'] = $house['created_at']->format('H:m d-m-Y');
        }

        return $searchByTypeAndAddressAndArea;
    }

    public function searchByTypeAndDistrict($data)
    {
        $searchByTypeAndDistrict = House::select(
            'houses.id',
            'houses.business_type_id',
            'houses.district_id',
            'users.name',
            'houses.user_id',
            'districts.district',
            'districts.address_id',
            'addresses.address',
            'home_information.area',
            'home_information.title',
            'business_types.typeName AS businessName',
            'houses.price',
            'houses.view',
            'houses.expired',
            'houses.created_at'
        )->join('users', 'users.id', '=', 'houses.user_id')
            ->join('districts', 'districts.id', '=', 'houses.district_id')
            ->join('addresses', 'districts.address_id', '=', 'addresses.id')
            ->join('home_information', 'home_information.house_id', '=', 'houses.id')
            ->join('business_types', 'business_types.id', '=', 'houses.business_type_id')
            ->where('houses.business_type_id', $data['selectBusiness'])
            ->where('houses.district_id', $data['selectDistrict'])
            ->orderBy('houses.created_at', 'desc')
            ->paginate(12);
        foreach ($searchByTypeAndDistrict as $house) {
            $photo = HomePhoto::where('house_id', $house['id'])->first();
            $house->photo = $photo['photoAddress'];
            $house['day_create'] = $house['created_at']->format('H:m d-m-Y');
        }

        return $searchByTypeAndDistrict;
    }

    public function getAddressHouse($id)
    {
        $houses = House::select(
            'houses.id',
            'houses.business_type_id',
            'houses.district_id',
            'users.name',
            'houses.user_id',
            'districts.district',
            'districts.address_id',
            'addresses.address',
            'home_information.area',
            'home_information.title',
            'business_types.typeName AS businessName',
            'houses.price',
            'houses.view',
            'houses.expired',
            'houses.created_at'
        )->join('users', 'users.id', '=', 'houses.user_id')
            ->join('districts', 'districts.id', '=', 'houses.district_id')
            ->join('addresses', 'districts.address_id', '=', 'addresses.id')
            ->join('home_information', 'home_information.house_id', '=', 'houses.id')
            ->join('business_types', 'business_types.id', '=', 'houses.business_type_id')
            ->where('districts.address_id', $id)
            ->orderBy('houses.created_at', 'desc')
            ->paginate(12);
        foreach ($houses as $house) {
            $photo = HomePhoto::where('house_id', $house['id'])->first();
            $house->photo = $photo['photoAddress'];
            $house['day_create'] = $house['created_at']->format('H:m d-m-Y');
        }

        return $houses;
    }

    public function getDistrictHouse($id)
    {
        $houses = House::select(
            'houses.id',
            'houses.business_type_id',
            'houses.district_id',
            'users.name',
            'houses.user_id',
            'districts.district',
            'districts.address_id',
            'addresses.address',
            'home_information.area',
            'home_information.title',
            'business_types.typeName AS businessName',
            'houses.price',
            'houses.view',
            'houses.expired',
            'houses.created_at'
        )->join('users', 'users.id', '=', 'houses.user_id')
            ->join('districts', 'districts.id', '=', 'houses.district_id')
            ->join('addresses', 'districts.address_id', '=', 'addresses.id')
            ->join('home_information', 'home_information.house_id', '=', 'houses.id')
            ->join('business_types', 'business_types.id', '=', 'houses.business_type_id')
            ->where('districts.id', $id)
            ->orderBy('houses.created_at', 'desc')
            ->paginate(12);
        foreach ($houses as $house) {
            $photo = HomePhoto::where('house_id', $house['id'])->first();
            $house->photo = $photo['photoAddress'];
            $house['day_create'] = $house['created_at']->format('H:m d-m-Y');
        }

        return $houses;
    }

    public function getHouseInUser($id)
    {
        $houses = House::select(
            'houses.id',
            'houses.business_type_id',
            'houses.district_id',
            'users.name',
            'houses.user_id',
            'districts.district',
            'districts.address_id',
            'addresses.address',
            'home_information.area',
            'home_information.title',
            'business_types.typeName AS businessName',
            'houses.price',
            'houses.view',
            'houses.expired',
            'houses.created_at'
        )->join('users', 'users.id', '=', 'houses.user_id')
            ->join('districts', 'districts.id', '=', 'houses.district_id')
            ->join('addresses', 'districts.address_id', '=', 'addresses.id')
            ->join('home_information', 'home_information.house_id', '=', 'houses.id')
            ->join('business_types', 'business_types.id', '=', 'houses.business_type_id')
            ->where('houses.user_id', $id)
            ->orderBy('houses.created_at', 'desc')
            ->paginate(12);
        foreach ($houses as $house) {
            $photo = HomePhoto::where('house_id', $house['id'])->first();
            $house->photo = $photo['photoAddress'];
            $house['day_create'] = $house['created_at']->format('H:m d-m-Y');
            
        }

        return $houses;
    }

    public function houseDelete($id){
        $house = House::findOrFail($id);
        $house->photos()->delete();
        $house->information()->delete();
        $house->votes()->delete();
        $house->comments()->delete();
        $house->delete();

        return true;
    }
}
