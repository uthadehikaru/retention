<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    public function agent():BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    public function invoices():HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
