<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = ['blog_id', 'comment', 'comment_id', 'name', 'email', 'website'];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function auther()
    {
        return User::where('email',$this->email)->first();
    }
}
