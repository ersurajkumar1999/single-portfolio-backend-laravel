<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSocialLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'platform',
        'icon',
        'link',
        'visibility',
        'status',
    ];

    /**
     * Get the user that owns the social link.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
