<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WellnessTip extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category',
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who created the tip.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}