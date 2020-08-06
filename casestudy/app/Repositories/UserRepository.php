<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    public function all()
    {
        $users = User::all();

        return $users;
    }

    public function fullUser()
    {
        $users = User::select('users.*', 'user_information.*')
        ->leftJoin('user_information', 'users.id', '=', 'user_information.user_id')
        ->get();

        return $users;
    }

    public function findById($userId)
    {
        return User::where('id', $userId)
            ->where('active', 1)
            ->with('user')
            ->firstOrFail();
    }

    public function findByUserName($userName)
    {

        return User::where('name', 'like', '%' . $userName . '%')
            ->where('active', 1)
            ->with('user')
            ->get()
            ->map
            ->format();
    }

    public function lock($userId)
    {
        $user = User::where('id', $userId)->firstOrFail();

        $user->update(['locked' => 1]);

        return $user;
    }

    protected function format($user)
    {
        return [
            'User_id' => $user->id,
            'name' => $user->name,
            'created_by' => $user->user->email,
            'last_updated' => $user->updated_at->diffForHumans(),
        ];
    }
}