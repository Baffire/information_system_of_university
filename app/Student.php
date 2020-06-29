<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function faculty()
    {
        return $this->belongsTo('App\Faculty');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function training_program()
    {
        return $this->belongsTo('App\Training_program');
    }

    public function title()
    {
        return $this->hasOne('App\Title');
    }

    public function title_from_student()
    {
        return $this->hasOne('App\Title_from_student');
    }

    public function adviser()
    {
        return $this->hasOne('App\Adviser');
    }

    public function title_confirm()
    {
        return $this->hasOne('App\Title_confirm');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function degree()
    {
        return $this->belongsTo('App\Degree');
    }

    public function degree_of_preparation()
    {
        return $this->hasOne('App\Degree_of_preparation');
    }
}
