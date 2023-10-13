<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];


    public function pages()
    {
        return $this->hasMany(Page::class, 'category_id', 'id');
    }
}
