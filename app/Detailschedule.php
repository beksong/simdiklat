<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailschedule extends Model
{
    protected $fillable=['masterschedule_id','user_id','subject_id','dateschedule','timeschedule','sessionschedule','jp','description','rpbmd','teaching_material','airing_material','uniqueschedule'];

    public function masterschedule()
    {
        return $this->belongsTo('App\Masterschedule');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
}
