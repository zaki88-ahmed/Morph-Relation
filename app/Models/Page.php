<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = ['id', 'name', 'about', 'logo', 'cover', 'website', 'phone', 'location', 'category_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'page_post');
    }


    public function medias(){
        return $this->morphToMany(Media::class, 'mediable');
    }

}
