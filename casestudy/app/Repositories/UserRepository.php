<?php

namespace App\Repositories;

use App\Models\UserInformation;
use App\User;
use App\Repositories\UserRepositoryInterface;


class UserRepository implements UserRepositoryInterface
{

    public function all()
    {
        $users = User::select('users.*',
        'user_information.avatar',
        'user_information.role',
        'user_information.locked')
        ->join('user_information', 'users.id', '=', 'user_information.user_id')
        ->where('users.isAdmin', 0)
            ->get();

        return $users;
    }

    public function show($id)
    {
        $user = User::select('users.*',
         'user_information.fullName', 
         'user_information.phone',  
         'user_information.address', 
         'user_information.gender',
         'user_information.role',
         'user_information.locked',
         'user_information.avatar')
            ->join('user_information', 'users.id', '=', 'user_information.user_id')
            ->where('users.id', $id)
            ->get();

        return $user;
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


}
