<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class StatusUserReg extends Model
{
    use Notifiable;
    use HasRoles;

    protected $table = "statususerreg";
    protected $primaryKey = 'id_status';
    protected $fillable = ['status_id_user', 'status_hour'];
    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'date:d-m-Y',
        'status_hour ' => 'date:d-m-Y H:i:s',
    ];
}
