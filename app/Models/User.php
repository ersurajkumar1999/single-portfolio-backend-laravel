<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'language',
        'gender',
        'dob',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['date_of_birthday'];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'language' => 'array',
        ];
    }

    // Accessor to format the date attribute

    public function setDateOfBirthdayAttribute()
    {
        return $this->dob ? Carbon::parse($this->dob)->format('jS F Y') : 'N/A';
    }

    public function generalSettings()
    {
        return $this->hasOne(UserGeneralSetting::class);
    }
    public function about()
    {
        return $this->hasOne(About::class);
    }
    public function skills()
    {
        return $this->hasOne(Skill::class);
    }
    public function userResume()
    {
        return $this->hasOne(UserResume::class);
    }

    public function service()
    {
        return $this->hasOne(Service::class);
    }
    public function portfolio()
    {
        return $this->hasOne(Portfolio::class);
    }
    public function testimonial()
    {
        return $this->hasOne(Testimonial::class);
    }

    public function socialLinks()
    {
        return $this->hasMany(UserSocialLink::class);
    }
}
