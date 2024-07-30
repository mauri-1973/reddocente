<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    protected $table = "categories";
    protected $primaryKey = 'id_cat';
    protected $fillable = ['name', 'carpeta'];
    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'date:d-m-Y',
        'deleted_at' => 'date:d-m-Y',
    ];

    public function resources()
    {
        return $this->hasMany('App\Resource');
    }

    public function scopeSearchCategory($query, $name)
    {
        return $query->where('name', $name);
    }
}
