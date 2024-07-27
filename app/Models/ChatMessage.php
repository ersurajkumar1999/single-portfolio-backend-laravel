<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $appends = ['time'];
    protected $fillable = [
        'user_id',
        'from',
        'message',
        'status',
        'conversation_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getTimeAttribute()
    {
        return Carbon::parse($this->created_at)->format('h:i A');
    }
}
