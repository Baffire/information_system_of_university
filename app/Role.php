<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function user()
    {
    	return $this->hasMany('App\User');
    }

    public function student()
    {
        return $this->hasMany('App\Student');
    }

    public function teacher()
    {
        return $this->hasMany('App\Teacher');
    }

    public function head()
    {
        return $this->hasMany('App\Head');
    }

    public function employee()
    {
        return $this->hasMany('App\Employee');
    }
}
