<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeInformation extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function house(){
        return $this->hasOne('App\Models\House', 'home_information_id', 'id');
    }

    public function photos(){
        return $this->hasMany('App\Models\HomePhoto', 'home_photo_id', 'id');
    }
}
