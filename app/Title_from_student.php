<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title_from_student extends Model
{
    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
}
