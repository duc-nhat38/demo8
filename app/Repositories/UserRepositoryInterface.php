<?php
namespace App\Repositories;

// use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface  {

    public function all();

    public function show($userId);

    public function lock($userId);

    public function unlock($userId);

    public function grantAuthority($userId);

    public function revokePowers($userId);

    public function update(Array $array);

    public function getHouses($id);

    public function getUser($id);

    public function updateAvatar($data);
}

?>