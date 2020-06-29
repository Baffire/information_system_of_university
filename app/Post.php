<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function teacher()
    {
        return $this->hasMany('App\Teacher');
    }
}
