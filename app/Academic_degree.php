<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academic_degree extends Model
{
    public function teacher()
    {
        return $this->hasMany('App\Teacher');
    }
}
