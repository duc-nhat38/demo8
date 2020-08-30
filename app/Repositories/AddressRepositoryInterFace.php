<?php

namespace App\Repositories;

interface AddressRepositoryInterface
{
    public function all();

    public function show($id);

    public function update(array $array);

    public function destroy($id);

    public function getAddressAll();

    public function create($data);
}
