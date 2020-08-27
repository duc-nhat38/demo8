<?php

namespace App\Repositories;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function getPostNews();

    public function view($id);

    public function postRandom();
}
