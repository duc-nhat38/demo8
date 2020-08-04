<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInformation extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
