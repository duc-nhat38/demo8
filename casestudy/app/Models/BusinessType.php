<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessType extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function houses(){
        return $this->hasMany('App\Models\House', 'business_type_id', 'id');
    }
}
