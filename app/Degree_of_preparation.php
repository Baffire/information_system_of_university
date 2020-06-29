<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree_of_preparation extends Model
{
    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function roadmap()
    {
        return $this->belongsTo('App\Roadmap');
    }

    public function file()
    {
        return $this->belongsTo('App\File');
    }
}
