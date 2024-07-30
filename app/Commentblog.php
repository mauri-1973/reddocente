<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commentblog extends Model
{
 
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    protected $table = "commentsblog";
    protected $fillable = [
        'body',
        'user_id',
        'post_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($comment) {
            if (is_null($comment->user_id)) {
                $comment->user_id = auth()->user()->id;
            }
        });
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}