<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function house(){
        return $this->belongsTo('App\Models\House', 'house_id', 'id');
    }
}
