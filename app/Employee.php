<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function faculty()
    {
        return $this->belongsTo('App\Faculty');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }
}
