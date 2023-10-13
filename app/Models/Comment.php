<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'isHidden', 'post_id', 'parent_id'];
    protected $hidden = ['created_at', 'updated_at'];
    public function post(){
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function comment(){
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'parent_id');
    }


    public function medias(){
        return $this->morphToMany(Media::class, 'mediable');
    }
}
