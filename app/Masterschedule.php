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
        return $this->hasMany('App\Detailschedule');
    }

    public function printedschedules()
    {
        return $this->hasMany('App\Printedschedule');
    }
}
