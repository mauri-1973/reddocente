<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Corrections extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    protected $table = "corrections";
    protected $primaryKey = 'idcorrec';
    protected $fillable = ['id_answ', 'resp1', 'resp2', 'resp3', 'resp4', 'resp5', 'resp6', 'resp7', 'ptje1', 'ptje2', 'ptje3', 'ptje4', 'ptje5', 'ptje6', 'ptje7', 'ptje8', 'ptje9', 'ptje10', 'ptje11', 'ptje12'];
    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'date:d-m-Y',
        'deleted_at' => 'date:d-m-Y',
    ];
}