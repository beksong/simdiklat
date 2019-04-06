<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PermissionRole extends Pivot
{
    protected $table ="permission_role";

    public function permission()
    {
        return $this->belongsTo('App\Permission');
    }

    public function role()
    {
        return $this->belongsTO('App\Role');
    }
}
