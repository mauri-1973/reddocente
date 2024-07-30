<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrainstormComment extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    protected $table = "brainstorm_comment";
    protected $primaryKey = 'idbraincom';
    protected $fillable = ['idbrainpart', 'titlebrain', 'commbrain', 'brains'];
    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'date:d-m-Y',
        'deleted_at' => 'date:d-m-Y',
    ];

}
