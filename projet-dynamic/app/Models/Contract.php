<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contract extends Model
{
    protected $fillable = [
        'user_id', 'tenant_id', 'property_id', 'type',
        'start_date', 'end_date', 'monthly_rent', 'charges', 'deposit', 'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    // Relations
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function tenant(): BelongsTo { return $this->belongsTo(Tenant::class); }
    public function property(): BelongsTo { return $this->belongsTo(Property::class); }

    // Scopes
    public function scopeActif($q) { return $q->where('status', 'actif'); }
    public function scopeExpirant($q, int $days = 30)
    {
        return $q->where('status', 'actif')
                 ->whereNotNull('end_date')
                 ->whereDate('end_date', '<=', now()->addDays($days));
    }
    public function scopeArchive($q) { return $q->where('status', 'archive'); }

    // Accessors
    public function getDurationAttribute(): ?int
    {
        if (!$this->end_date) return null;
        return $this->start_date->diffInMonths($this->end_date);
    }

    public function getIsExpiringAttribute(): bool
    {
        return $this->end_date && $this->end_date->lte(now()->addDays(30)) && $this->status === 'actif';
    }
}
