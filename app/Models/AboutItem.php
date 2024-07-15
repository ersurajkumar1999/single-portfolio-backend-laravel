<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'about_id', 'icon', 'number', 'text', 'status'
    ];

    public function about()
    {
        return $this->belongsTo(About::class);
    }
}
