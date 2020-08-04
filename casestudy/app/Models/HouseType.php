<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HouseType extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function houses(){
        return $this->hasMany('App\Models\House', 'house_type_id', 'id');
    }
}
