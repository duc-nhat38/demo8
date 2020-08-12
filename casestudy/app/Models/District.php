<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function address(){
        return $this->belongsTo('App\Models\Address', 'address_id', 'id');
    }
    public function houses(){
        return $this->hasMany('App\Models\House', 'districts_id', 'id');
    }
}
