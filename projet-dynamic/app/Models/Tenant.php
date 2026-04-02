<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    protected $fillable = [
        'user_id', 'property_id', 'first_name', 'last_name',
        'email', 'phone', 'monthly_rent', 'lease_start_date', 'payment_status',
    ];

    protected $casts = [
        'lease_start_date' => 'date',
    ];

    // Relations
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function property(): BelongsTo { return $this->belongsTo(Property::class); }
    public function payments(): HasMany { return $this->hasMany(Payment::class); }
    public function contracts(): HasMany { return $this->hasMany(Contract::class); }

    // Scopes
    public function scopePaye($q) { return $q->where('payment_status', 'paye'); }
    public function scopeAttente($q) { return $q->where('payment_status', 'attente'); }
    public function scopeRetard($q) { return $q->where('payment_status', 'retard'); }
    public function scopeSearch($q, string $search)
    {
        return $q->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    // Accessors
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getInitialsAttribute(): string
    {
        return strtoupper(substr($this->first_name, 0, 1) . substr($this->last_name, 0, 1));
    }

    public function getIsLateAttribute(): bool
    {
        return $this->payment_status === 'retard';
    }
}
