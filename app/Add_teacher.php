<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Add_teacher extends Model
{
    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    public function title_confirm()
    {
        return $this->belongsTo('App\Title_confirm');
    }
}
