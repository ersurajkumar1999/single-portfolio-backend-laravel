<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'title', 'description'
    ];

    public function items()
    {
        return $this->hasMany(TestimonialItem::class)->orderBy('id', 'desc');
    }
}
