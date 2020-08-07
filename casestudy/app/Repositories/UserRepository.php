<?php

namespace App\Repositories;

use App\User;
use App\Repositories\UserRepositoryInterface;


class UserRepository implements UserRepositoryInterface
{

    public function all()
    {
        $users = User::where('isAdmin', 0)
            ->get();

        return $users;
    }

    public function show($id)
    {
        $user = User::select('users.*', 'user_information.fullName', 'user_information.phone',  'user_information.address', 'user_information.gender')
            ->leftJoin('user_information', 'users.id', '=', 'user_information.user_id')
            ->where('users.id', $id)
            ->get();

        return $user;
    }

    public function lock($userId)
    {
        $user = User::find($userId);
        $user->locked = 1;
        $user->save();

        return $user;
    }

    public function unlock($userId)
    {
        $user = User::find($userId);
        $user->locked = 0;
        $user->save();

        return $user;
    }

    public function grantAuthority($userId)
    {
        $user = User::find($userId);
        $user->role = 1;
        $user->save();

        return $user;
    }

    public function revokePowers($userId)
    {
        $user = User::find($userId);
        $user->role = 0;
        $user->save();

        return $user;
    }


}
