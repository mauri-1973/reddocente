<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class LinkExt extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    protected $table = "linkext";
    protected $primaryKey = 'idlinkext';
    protected $fillable = ['nombreini', 'urlext', 'nombresub', 'tipo'];
    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'date:d-m-Y',
        'deleted_at' => 'date:d-m-Y',
    ];
}
