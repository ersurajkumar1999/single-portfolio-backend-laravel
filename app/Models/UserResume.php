<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResume extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'description', 'summary_heading', 'summary_title', 'summary_content', 'status'
    ];

    public function educationEntries()
    {
        return $this->hasMany(EducationEntry::class, 'resume_id')->orderBy('id', 'desc');
    }

    public function experienceEntries()
    {
        return $this->hasMany(ExperienceEntry::class, 'resume_id')->orderBy('id', 'desc');
    }
}
