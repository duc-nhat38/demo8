<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user(){
        return $this->belongsToMany('App\Models\User', 'user_id', 'id');
    }
    public function house(){
        return $this->belongsToMany('App\Models\House', 'house_id', 'id');
    }
}
