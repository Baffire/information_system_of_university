<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title_confirm extends Model
{

    public function title()
    {
        return $this->belongsTo('App\Title');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function add_teacher()
    {
        return $this->hasOne('App\Add_teacher');
    }
}
