<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'user_id', 'id');
    }

    public function houses()
    {
        return $this->hasMany('App\Models\House', 'user_id', 'id');
    }

    public function votes()
    {
        return $this->hasMany('App\Models\Vote', 'user_id', 'id');
    }
    public function pots()
    {
        return $this->hasMany('App\Models\Post', 'user_id', 'id');
    }
    public function banners(){
        return $this->hasMany('App\Models\BannerImage', 'user_id', 'id');
    }
    public function information()
    {
        return $this->hasOne('App\Models\UserInformation', 'user_id', 'id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
