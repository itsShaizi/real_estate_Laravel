<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
    /*
    * Blog will have a slug
    */
    protected static function boot() {
        parent::boot();

        static::creating(function ($blog) {
            $blog->slug = self::createSlug($blog->title);
        });
        static::updating(function ($blog) {
            $blog->slug = self::createSlug($blog->title,$blog->id);
        });
    }
    public static function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = Str::slug($title);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = self::getRelatedSlugs($slug, $id);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 100; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    protected static function getRelatedSlugs($slug, $id = 0)
    {
        return Blog::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }

}
