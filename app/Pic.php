<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    protected $fillable = ['user_id','institution_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }

    public function trainings()
    {
        return $this->hasMany('App\Training');
    }
}
