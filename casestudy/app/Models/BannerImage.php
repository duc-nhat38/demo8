<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerImage extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function user(){
        return $this->belongsToMany('App\User', 'user_id', 'id');
    }
}
