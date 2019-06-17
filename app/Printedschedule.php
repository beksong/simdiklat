<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Printedschedule extends Model
{
    protected $fillable=['masterschedule_id','dateschedule','timeschedule','subject','jp','sessionschedule','speaker','description','uniqueschedule'];

    public function masterschedule()
    {
        return $this->belongsTo('App\Masterschedule');
    }
}
