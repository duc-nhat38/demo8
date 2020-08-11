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

}

?>