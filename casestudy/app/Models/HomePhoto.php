<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomePhoto extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function information(){
        return $this->belongsTo('App\Models\HomeInformation', 'home_photo_id', 'id');
    }
}
