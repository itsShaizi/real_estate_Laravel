<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
        'active',
        'is_contact',
        'primary_company'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        //once created/inserted successfully this method fired
        static::created(function (User $user) {
            $email = new Email;
            $email->fill([
                'email' => $user->email,
                'email_type' => 'primary',
                'main' => 1,
            ]);
            $user->emails()->save($email);
        });
    }

    public function emails()
    {
        return $this->morphMany(Email::class, 'ref');
    }

    public function phones()
    {
        return $this->morphMany(Phone::class, 'ref');
    }

    public function listings()
    {
        return $this->belongsToMany(Listing::class)
            ->withPivot('group_id')
            ->withTimestamps();
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'user_group')
            ->withTimestamps();
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'ref');
    }

    public function getAvatarAttribute()
    {
        return optional($this->images->last())->image_thumb_path;
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'ref');
    }

    public function licenses()
    {
        return $this->morphMany(License::class, 'ref');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'primary_company');
    }

    public function getUserListingGroups($user,$listing)
    {   
        $groups = ListingUser::where('user_id', $user->id)->where('listing_id', $listing->id)->get('group_id')->toArray();
        $groups = Arr::flatten($groups);
        $listingroups = Group::whereIn('id', $groups)->get('name')->toArray();
        $listin_group_name_arr = array();
        $listin_group_name = '';
        if(count($listingroups) > 0) {
            foreach($listingroups as $listingroup) {
               $listin_group_name_arr[] = $listingroup['name'];
            }
           $listin_group_name = implode(', ', $listin_group_name_arr);
        }
        return $listin_group_name;
    }
}
