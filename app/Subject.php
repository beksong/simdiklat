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

    public function schedules()
    {
        return $this->hasMany('App\Schedules');
    }
}
