<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnswersDirector extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    protected $table = "answersdirector";
    protected $primaryKey = 'idansdir';
    protected $fillable = ['id_answ', 'namedir', 'rutdir', 'faculdir', 'jordir', 'tipodir', 'antidir', 'teldir', 'emaildir', 'horasdir', 'niveldir', 'typedir'];
    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'date:d-m-Y',
        'deleted_at' => 'date:d-m-Y',
    ];
}