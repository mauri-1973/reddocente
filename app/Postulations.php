<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Postulations extends Model
{
    use Notifiable;
    use HasRoles;

    protected $table = "postulations";
    protected $primaryKey = 'idpost';
    protected $fillable = ['idconc', 'idus', 'status'];
    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'date:d-m-Y',
    ];

    
    public static function countpost($id = null)
    {
       $user = static::where('idconc', $id)->count();
       return $user;
    
    }
}