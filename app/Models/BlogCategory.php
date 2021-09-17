<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

	protected $fillable = ['name'];
    protected $table = 'blog_categories';

    public function blogs(){

        return $this->hasMany(Blog::class , 'category_id');
    }
}
