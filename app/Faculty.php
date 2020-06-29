<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    public function student()
    {
        return $this->hasMany('App\Student');
    }

    public function teacher()
    {
        return $this->hasMany('App\Teacher');
    }

    public function training_program()
    {
        return $this->hasMany('App\Training_program');
    }

    public function title()
    {
        return $this->hasMany('App\Title');
    }

    public function department()
    {
        return $this->hasMany('App\Department');
    }

    public function head()
    {
        return $this->hasMany('App\Head');
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
