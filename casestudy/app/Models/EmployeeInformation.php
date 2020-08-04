<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeInformation extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function employee(){
        return $this->belongsTo('App\Models\Employee', 'employee_id', 'id');
    }
}
