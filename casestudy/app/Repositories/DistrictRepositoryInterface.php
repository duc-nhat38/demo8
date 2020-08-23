<?php

namespace App\Repositories;

interface DistrictRepositoryInterface
{
    public function all();

    public function show($id);

    public function update(Array $array);

    public function destroy($id);
}
