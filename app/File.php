<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function degree_of_preparation()
    {
        return $this->hasOne('App\Degree_of_preparation');
    }
}
