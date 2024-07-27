<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'testimonial_id', 'profession', 'name', 'image', 'feedback', 'start', 'status'
    ];

    public function testimonial()
    {
        return $this->belongsTo(Testimonial::class);
    }
}


