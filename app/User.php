<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Role;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'patronymic', 'surname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function role()
    {
    	return $this->belongsTo('App\Role');
    }

    public function student()
    {
        return $this->hasOne('App\Student');
    }

    public function teacher()
    {
        return $this->hasOne('App\Teacher');
    }

    public function head()
    {
        return $this->hasOne('App\Head');
    }

    public function employee()
    {
        return $this->hasOne('App\Employee');
    }

    public function notification()
    {
        return $this->hasMany('App\Notification');
    }

    public function file()
    {
        return $this->hasMany('App\File');
    }
}
