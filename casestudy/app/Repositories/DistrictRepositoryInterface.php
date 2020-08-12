<?php

namespace App\Repositories;

interface DistrictRepositoryInterface
{
    public function all();

    public function show($id);

    public function create(Array $array);
}
