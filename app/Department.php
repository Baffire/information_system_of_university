<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function faculty()
    {
        return $this->belongsTo('App\Faculty');
    }

    public function head()
    {
        return $this->hasMany('App\Head');
    }

    public function student()
    {
        return $this->hasMany('App\Student');
    }

    public function teacher()
    {
        return $this->hasMany('App\Teacher');
    }

    public function title_confirm()
    {
        return $this->hasMany('App\Title_confirm');
    }

    public function employee()
    {
        return $this->hasMany('App\Employee');
    }

    public function notification()
    {
        return $this->hasMany('App\Notification');
    }
}
