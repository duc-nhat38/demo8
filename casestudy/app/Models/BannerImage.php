<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerImage extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function employee(){
        return $this->belongsToMany('App\Models\Employee', 'employee_id', 'id');
    }
}
