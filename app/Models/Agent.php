<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agent extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        return $query->whereNull('resign_date');
    }

    public function scopeInactive($query)
    {
        return $query->whereNotNull('resign_date');
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class); 
    }
}
