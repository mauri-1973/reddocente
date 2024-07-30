<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    protected $table = "subcategories";
    protected $primaryKey = 'id_sub';
    protected $fillable = ['id_sub', 'name', 'cat_id', 'carpeta'];
    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'date:d-m-Y',
        'deleted_at' => 'date:d-m-Y',
    ];

    
}

