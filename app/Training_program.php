<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training_program extends Model
{
    public $timestamps = null;

    public function student()
    {
        return $this->hasMany('App\Student');
    }

    public function faculty()
    {
        return $this->hasOne('App\Faculty');
    }

    public function notification()
    {
        return $this->hasMany('App\Notification');
    }

    public function roadmap()
    {
        return $this->hasMany('App\Roadmap');
    }

    public function title()
    {
        return $this->hasMany('App\Title');
    }
}
