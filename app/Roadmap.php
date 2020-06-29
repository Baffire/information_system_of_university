<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    public function degree()
    {
        return $this->belongsTo('App\Degree');
    }

    public function training_program()
    {
        return $this->belongsTo('App\Training_program');
    }

    public function degree_of_preparation()
    {
        return $this->hasMany('App\Degree_of_preparation');
    }
}
