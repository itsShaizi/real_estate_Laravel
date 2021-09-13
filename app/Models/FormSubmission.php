<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    use HasFactory;

    protected $fillable = ['first_name','last_name','email','message','phone_number','form_submission_type', 'listing_id'];


    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }
}
