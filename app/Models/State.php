<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function country() {
    	return $this->belongsTo(Country::class);
    }
}
