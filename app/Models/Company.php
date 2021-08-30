<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    
    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function state() {
        return $this->belongsTo(State::class);
    }

    public function emails() {
        return $this->morphMany(Email::class, 'ref');
    }

    public function phones() {
        return $this->morphMany(Phone::class, 'ref');
    }
}
