<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;


class Resource extends Model 
{
  use Notifiable;
  use HasRoles;
  use SoftDeletes;

  
  protected $table = "resources";
  protected $primaryKey = 'id_rec';
  protected $fillable = ['title', 'author', 'category_id', 'user_id', 'folder'];

// un recurso solo puede tener una categoria por eso esta en singular
  public function subcategory()
  {
      return $this->belongsTo('App\Subcategory');
  }

  public function user()
  {
      return $this->belongsTo('App\User');
  }

// relacion 1 a 1 ver laravel 5.1 docs
  public function book()
   {
       return $this->hasOne('App\Book');
   }

   public function tags()
   {
       return $this->belongsToMany('App\Tag');
   }

   public function scopeSearch($query, $title)
   {
     return $query->where('title', 'LIKE', "%$title%");
   }

   public static function filterAndPaginate($title)
   {
      return Resource::search($title)
                     ->orderBy('id','DESC')
                     ->paginate(10);
   }

}
