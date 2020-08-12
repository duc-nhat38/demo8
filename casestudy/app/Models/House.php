<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class House extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function businessType()
    {
        return $this->belongsTo('App\Models\BusinessType', 'business_type_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'house_id', 'id');
    }

    public function information()
    {
        return $this->belongsTo('App\Models\HomeInformation', 'home_information_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function votes()
    {
        return $this->hasMany('App\Models\Vote', 'house_id', 'id');
    }

    public function houseType()
    {
        return $this->belongsTo('App\Models\HouseType', 'house_type_id', 'id');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\District', 'districts_id', 'id');
    }
}
