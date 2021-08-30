<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * The tag may have linked with many blogs.
     */
    public function tags()
    {
        return $this->belongsToMany(Blog::class);
    }
}
