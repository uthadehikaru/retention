<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InvoiceAgent extends Model
{
    use HasFactory;

    public function agent():BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    public function invoice():BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function contacts():HasMany
    {
        return $this->hasMany(Contact::class);
    }
}
