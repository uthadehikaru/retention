<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function payments():HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function contacts():HasMany
    {
        return $this->hasMany(Contact::class);
    }
}
