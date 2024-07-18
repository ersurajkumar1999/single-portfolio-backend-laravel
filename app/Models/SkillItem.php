<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'skill_id', 'name', 'value', 'status'
    ];

    public function skill()
    {
        return $this->belongsTo(Skill::class)->orderBy('id', 'desc');
    }
}
