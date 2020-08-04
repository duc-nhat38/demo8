<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddressDetails extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function address(){
        return $this->belongsToMany('App\Models\Address', 'address_id', 'id');
    }
    public function houses(){
        return $this->hasMany('App\Models\House', 'address_details_id', 'id');
    }
}
