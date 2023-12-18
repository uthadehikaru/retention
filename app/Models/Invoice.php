<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Invoice extends Model
{
    use HasFactory;

    public function scopeUnpaid($query)
    {
        return $query->doesntHave('payments');
    }

    public function scopePaid($query)
    {
        return $query->whereHas('payments');
    }

    public function scopeSuspended($query)
    {
        return $query->whereNotNull('suspend_date');
    }

    public function scopeTerminated($query)
    {
        return $query->whereNotNull('terminate_date');
    }

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

    public function agents():BelongsToMany
    {
        return $this->belongsToMany(Agent::class, 'invoice_agents');
    }  
}
