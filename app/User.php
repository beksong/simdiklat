<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nip',
        'religion',
        'place_birth',
        'date_birth',
        'gender',
        'photo',
        'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pic()
    {
        return $this->hasOne('App\Pic')->select('id');    
    }                                                                                                                                                       

    public function speakers()
    {
        return $this->hasMany('App\Speaker');
    }

    public function detailschedules()
    {
        return $this->hasMany('App\Detailschedule');
    }
    
    public function participants()
    {
        return $this->hasMany('App\Participant');
    }
}
