<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

	protected $fillable = ['title', 'content'];

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
        return $this->morphOne(Image::class,'ref');
    }

    /*
    * Blog will have a cover photo
    * but this method used for image upload
    */
    public function images()
    {
        return $this->morphOne(Image::class,'ref');
    }

    /*
    * Blog will have an author
    */
    public function author()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
