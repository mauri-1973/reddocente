<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class AnswersStatus extends Model
{
    use Notifiable;
    use HasRoles;

    protected $table = "answersstatus";
    protected $primaryKey = 'idanswstat';
    protected $fillable = ['id_anwsstat', 'estapa1', 'etapa2', 'etapa3', 'etapa4'];
    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'date:d-m-Y',
    ];
}