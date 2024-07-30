<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagblog extends Model
{
    
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    protected $table = "tagsblog";

    protected $fillable = ['title'];

    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }
}