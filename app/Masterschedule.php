<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masterschedule extends Model
{
    protected $fillable = ['training_id','type','nameschedulemaster'];

    public function training()
    {
        return $this->belongsTo('App\Training');
    }

    public function detailschedules()
    {
        return $this->hasMany('App\DetailSchedule');
    }
}
