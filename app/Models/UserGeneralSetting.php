<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGeneralSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'app_name',
        'banner_image',
        'header_title',
        'header_description',
        'nav_items',
        'contact_title',
        'contact_description',
        'social_links',
        'number1',
        'number2',
        'email1',
        'email2',
        'address',
        'copyright_description',
    ];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
