<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = ['user_id','training_id','fullname','frontdegree','backdegree','rank','position','institution','propername','properdocs','properslug','properabstract'];
    public function training()
    {
        return $this->belongsTo('App\Training');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
