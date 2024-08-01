<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'image', 'title', 'description', 'my_title', 'my_description',
    ];

    public function items()
    {
        return $this->hasMany(AboutItem::class)->orderBy('id', 'desc');
    }
}
