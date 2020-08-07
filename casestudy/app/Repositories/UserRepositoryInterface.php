<?php
namespace App\Repositories;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface {

    public function lock($userId);

    public function unlock($userId);

    public function grantAuthority($userId);

    public function revokePowers($userId);

}

?>