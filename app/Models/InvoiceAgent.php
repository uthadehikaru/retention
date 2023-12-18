<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class InvoiceAgent extends Model
{
    use HasFactory;

    public function scopeOwn($query)
    {
        return $query
        ->whereAgentId(Auth::user()->agent?->id);
    }

    public function scopeToday($query)
    {
        return $query
        ->whereDate('start_date','<=',Carbon::now())
        ->whereDate('end_date','>=',Carbon::now());
    }

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
