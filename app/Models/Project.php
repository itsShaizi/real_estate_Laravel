<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function images() {
        return $this->morphMany(Image::class, 'ref');
    }

    public function videos() {
        return $this->morphMany(Video::class, 'ref');
    }
    
}
