<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationEntry extends Model
{
    use HasFactory;
    protected $fillable = ['resume_id', 'course_name', 'batch', 'course_content', 'status'];

    public function resume()
    {
        return $this->belongsTo(UserResume::class, 'resume_id');
    }
}
