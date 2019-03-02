<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name','slug'];

    public function speakers()
    {
        return $this->hasMany('App\Speaker');
    }

    public function detailschedules()
    {
        return $this->hasMany('App\Detailschedule');
    }
}
