<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function teacher()
    {
        return $this->hasMany('App\Teacher');
    }
}
