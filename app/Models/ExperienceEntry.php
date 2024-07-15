<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceEntry extends Model
{
    use HasFactory;
    protected $fillable = ['resume_id', 'job_role', 'duration', 'location', 'job_description'];

    public function resume()
    {
        return $this->belongsTo(UserResume::class, 'resume_id');
    }
}
