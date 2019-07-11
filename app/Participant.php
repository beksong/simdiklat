<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'user_id',
        'training_id',
        'fullname',
        'participant_type',
        'phone',
        'frontdegree',
        'backdegree',
        'rank',
        'position',
        'institution',
        'institution_address',
        'institution_phone',
        'requirements',
        'propername',
        'properplan',
        'properdocs',
        'properslug',
        'unit_institution',
        'properabstract'
    ];

    public function training()
    {
        return $this->belongsTo('App\Training');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
