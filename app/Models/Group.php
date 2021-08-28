<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $appends = [
        'slug'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_group')
            ->withTimestamps();
    }

    public function getSlugAttribute()
    {   
        return strtolower(implode('_', explode(' ', $this->name)));
    }
}
