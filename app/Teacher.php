<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function title()
    {
        return $this->hasMany('App\Title');
    }

    public function titles_from_student()
    {
        return $this->hasOne('App\Title_from_student');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function faculty()
    {
        return $this->belongsTo('App\Faculty');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function academic_degree()
    {
        return $this->belongsTo('App\Academic_degree');
    }

    public function adviser()
    {
        return $this->hasOne('App\Adviser');
    }

    public function title_confirm()
    {
        return $this->hasMany('App\Title_confirm');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function title_from_student()
    {
        return $this->hasOne('App\Title_from_student');
    }

    public function add_teacher()
    {
        return $this->hasMany('App\Add_teacher');
    }
}
