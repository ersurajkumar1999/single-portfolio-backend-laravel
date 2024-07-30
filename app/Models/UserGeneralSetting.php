<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGeneralSetting extends Model
{
    use HasFactory;
    // Define the fillable attributes
    protected $fillable = [
        'user_id',
        'header_title',
        'header_description',
        'banner_image',
        'nav_items',
        'employment_type',
        'is_freelancer',
        'hourly_rate_min',
        'hourly_rate_max',
        'experience',
        'currency_type',
        'contact_title',
        'contact_description',
        'number1',
        'number2',
        'email1',
        'email2',
        'address',
        'city',
        'state',
        'country',
        'copyright_description',
        'theme_color',
    ];

    // Define the employment types array as a static property
    public static $employmentTypes = [
        'Full-time',
        'Part-time',
        'Self-employed',
        'Freelance',
        'Internship',
        'Trainee'
    ];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
