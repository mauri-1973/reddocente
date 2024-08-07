<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile','avatar', 'surname', 'cargo_us', 'status_us', 'cambio_pass', 'profesion', 'conectar'
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

    public function gcCaptures(){
        return $this->hasMany('App\Capturegc');
    }

    public static function userCount(){
        return User::count();
    }
    public function resources()
    {
        return $this->hasMany('App\Resource');
    }

    public function admin()
    {
      return $this->type === 'admin';
    }
}
