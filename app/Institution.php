<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable=['name','slug'];

    public function pics()
    {
        return $this->hasMany('App\Pic');
    }
}
