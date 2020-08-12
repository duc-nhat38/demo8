<?php

namespace App\Repositories;

interface AddressRepositoryInterface
{
    public function all();

    public function show($id);

    public function create( array $array);
}
