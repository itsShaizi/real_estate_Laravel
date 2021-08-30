<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    /**
     * The blog may have many tags.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /*
    * Blog will have a cover photo
    */
    public function cover_image()
    {
        return $this->hasOne(Image::class);
    }

    /*
    * Blog will have an author
    */
    public function author()
    {
        return $this->hasOne(User::class);
    }
}
