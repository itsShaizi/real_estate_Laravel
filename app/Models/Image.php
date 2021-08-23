<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $appends = [
        'image_thumb_path',
        'image_original_path',
    ];

    public function ref()
    {
    	return $this->morphTo();
    }

    public function getImageThumbPathAttribute()
    {
        return "/storage/{$this->parseFolder($this->ref_type)}/images/{$this->ref_id}/thumb/{$this->title}";
    }

    public function getImageOriginalPathAttribute()
    {
        return "/storage/{$this->parseFolder($this->ref_type)}/images/{$this->ref_id}/original/{$this->title}";
    }

    private function parseFolder($ref_type)
    {
        return (string) Str::of($ref_type)->afterLast('\\')->snake()->lower()->plural();
    }
}
