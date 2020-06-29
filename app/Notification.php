<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    public function faculty()
    {
        return $this->belongsTo('App\Faculty');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function training_program()
    {
        return $this->belongsTo('App\Training_program');
    }
}
