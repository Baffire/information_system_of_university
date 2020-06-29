<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adviser extends Model
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

}
