<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeInformation extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function house(){
        return $this->belongsTo('App\Models\House', 'house_id', 'id');
    }

    
}
