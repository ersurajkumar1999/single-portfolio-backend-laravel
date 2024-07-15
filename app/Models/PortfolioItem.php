<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'portfolio_id',
        'name',
        'link',
    ];

    /**
     * Get the portfolio that owns the item.
     */
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
