<?php

namespace App\Repositories;

use App\Models\BusinessType;
use App\Repositories\BusinessRepositoryInterface;

class BusinessRepository implements BusinessRepositoryInterface
{
    public function all()
    {
        $business = BusinessType::all();

        return $business;
    }

}
