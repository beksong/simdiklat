<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleUser extends Pivot
{
    protected $table="role_user";

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
