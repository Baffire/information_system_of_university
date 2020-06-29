<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    public function faculty()
    {
        return $this->belongsTo('App\Faculty');
    }

    public function adviser()
    {
        return $this->hasOne('App\Adviser');
    }

    public function title_confirm()
    {
        return $this->hasOne('App\Title_confirm');
    }

    public function year()
    {
        return $this->belongsTo('App\Year');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function training_program()
    {
        return $this->belongsTo('App\Training_program');
    }

    public function degree()
    {
        return $this->belongsTo('App\Degree');
    }
}
