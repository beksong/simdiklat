<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable=['name','slug','start_date','period','end_date','pic_id','description','status'];

    public function pic()
    {
        return $this->belongsTo('App\Pic');
    }

    public function masterschedules()
    {
        return $this->hasMany('App\Masterschedule');
    }

    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }

    public function participants()
    {
        return $this->hasMany('App\Participant');
    }
}
