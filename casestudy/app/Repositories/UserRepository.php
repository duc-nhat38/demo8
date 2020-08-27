<?php

namespace App\Repositories;

use App\Models\UserInformation;
use App\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\File;


class UserRepository implements UserRepositoryInterface
{

    public function all()
    {
        $users = User::select(
            'users.*',
            'user_information.avatar',
            'user_information.role',
            'user_information.locked'
        )
            ->join('user_information', 'users.id', '=', 'user_information.user_id')
            ->where('users.isAdmin', 0)
            ->get();

        return $users;
    }

    public function update(array $array)
    {
        $user = User::where('id', $array['id'])->update([
            'name' =>  $array['name'],
            'email' =>  $array['email']
        ]);
        $userInfo = UserInformation::where('user_id', $array['id'])->update([
            'fullName' => $array['fullName'],
            'phone' => $array['phone'],
            'address' => $array['address'],
        ]);

        return true;
    }

    public function show($id)
    {
        $user = User::select(
            'users.*',
            'user_information.fullName',
            'user_information.phone',
            'user_information.address',
            'user_information.role',
            'user_information.locked',
            'user_information.avatar'
        )
            ->join('user_information', 'users.id', '=', 'user_information.user_id')
            ->where('users.id', $id)
            ->get();

        return $user[0];
    }

    public function lock($userId)
    {
        $user = UserInformation::where('user_id', $userId)->get();
        $user[0]->locked = '1';
        $user[0]->save();

        return $user;
    }

    public function unlock($userId)
    {
        $user = UserInformation::where('user_id', $userId)->get();
        $user[0]->locked = 0;
        $user[0]->save();

        return $user;
    }

    public function grantAuthority($userId)
    {
        $user = UserInformation::where('user_id', $userId)->get();
        $user[0]->role = 1;
        $user[0]->save();

        return $user;
    }

    public function revokePowers($userId)
    {
        $user = UserInformation::where('user_id', $userId)->get();
        $user[0]->role = 0;
        $user[0]->save();

        return $user;
    }

    public function getHouses($id)
    {
        $houses = User::findOrFail($id)->with('houses')->get();

        return $houses;
    }

    public function getUser($id)
    {
        $user = User::select(
            'users.id',
            'users.name',
            'users.created_at',
            'user_information.phone',
            'user_information.address',
            'user_information.role',
            'user_information.avatar'
        )
            ->join('user_information', 'users.id', '=', 'user_information.user_id')
            ->where('users.id', $id)
            ->first();
        $user['day_create'] = $user['created_at']->format('d-m-Y');

        return $user;
    }

    public function updateAvatar($data)
    {
        $user = UserInformation::where('user_id', $data['id'])->first();
        $file_path = public_path('uploads/images/users/user-'.$user['id'] . '/' . $user['avatar']);
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
        $fileName = time() . rand() . '.' . $data['inputAvatar']->getClientOriginalExtension();
        $data['inputAvatar']->move(public_path("uploads/images/users/user-" . $user['id']), $fileName);
        $user->update([
            'avatar' => $fileName
        ]);

        return $fileName;
    }
}
