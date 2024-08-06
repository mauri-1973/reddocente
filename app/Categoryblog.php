<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoryblog extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    
    protected $guarded = [];
    
    protected $table = "categoriesblog";

    protected static function boot()
    {
        parent::boot();
//        static::deleting(function ($category) {
//            $category->posts()->delete();
//        });
    }

    public function posts()
    {
        return $this->hasMany(Post::class,'category_id');
    }
}