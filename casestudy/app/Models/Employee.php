<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function information(){
        return $this->hasOne('App\Models\EmployeeInformation', 'employee_id', 'id');
    }
    public function posts(){
        return $this->hasMany('App\Models\Post', 'employee_id', 'id');
    }

    public function banners(){
        return $this->hasMany('App\Models\BannerImage', 'employee_id', 'id');
    }

}
