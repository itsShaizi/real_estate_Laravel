<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'companies';

    protected $fillable = ['name','type','address','external_link','city','state_id','country_id','zip','license','active'];

    const TYPES = [
        'mortgage_firm' => 'Mortgage Firm',
        'real_estate_agency' => 'Real Estate Agency',
        'title_company' => 'Title Company',
        'developer' => 'Developer',
        'investment_firm' => 'Investment Firm',
        'property_management' => 'Property Management',
        'inspector' => 'Inspector',
        'appraiser' => 'Appraiser',
        'contractor' => 'Contractor',
        'construction_company' => 'Contruction Company',
        'consulting_firm' => 'Consulting Firm',
        'bank' => 'Bank',
        'government_agency' => 'Government Agency',
        'law_firm' => 'Law Firm',
        'service_provider' => 'Service Provider',
        'other' => 'Other',
    ];

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

    public function images() {
        return $this->morphMany(Image::class, 'ref');
    }

    public function getLogoAttribute()
    {
        return optional($this->images->last())->image_thumb_path;
    }
}
