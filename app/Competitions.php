<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competitions extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    protected $table = "competitions";
    protected $primaryKey = 'idcomp';
    protected $fillable = ['title', 'category_id', 'body', 'thumbnail', 'created_by', 'date_on', 'date_off', 'is_published', 'applicants'];
    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'date:d-m-Y',
        'deleted_at' => 'date:d-m-Y',
    ];

    public static function sendautor($id = null)
    {
       $user = User::find($id)->first();
       return $user->name.' '.$user->surname;
    }
}