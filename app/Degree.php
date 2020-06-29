<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    public function student()
    {
        return $this->hasMany('App\Student');
    }

    public function roadmap()
    {
        return $this->hasMany('App\Roadmap');
    }

    public function title()
    {
        return $this->hasOne('App\Title');
    }
}
