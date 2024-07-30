<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class AnswersFiles extends Model
{
    use Notifiable;
    use HasRoles;

    protected $table = "answersfiles";
    protected $primaryKey = 'idanswfile';
    protected $fillable = ['id_answ', 'dirfile', 'descripcion'];
    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'date:d-m-Y',
    ];
}