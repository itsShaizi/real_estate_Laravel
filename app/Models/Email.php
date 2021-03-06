<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = ['email','email_type','main','sort_order'];

    public function ref() {

    	return $this->morphTo();

    }
}
