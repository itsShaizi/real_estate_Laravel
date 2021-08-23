<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';
    
    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function companies()
    {
        return $this->hasMany(Comany::class);
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
