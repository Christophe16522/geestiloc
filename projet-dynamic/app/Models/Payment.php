<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'user_id', 'tenant_id', 'property_id',
        'amount', 'period_month', 'period_year', 'payment_date', 'status',
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];

    // Relations
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function tenant(): BelongsTo { return $this->belongsTo(Tenant::class); }
    public function property(): BelongsTo { return $this->belongsTo(Property::class); }

    // Scopes
    public function scopePaye($q) { return $q->where('status', 'paye'); }
    public function scopeAttente($q) { return $q->where('status', 'attente'); }
    public function scopeRetard($q) { return $q->where('status', 'retard'); }
    public function scopeByMonth($q, int $month) { return $q->where('period_month', $month); }
    public function scopeByYear($q, int $year) { return $q->where('period_year', $year); }

    // Accessor
    public function getPeriodLabelAttribute(): string
    {
        $months = [
            1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
            9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre',
        ];
        return ($months[$this->period_month] ?? $this->period_month) . ' ' . $this->period_year;
    }
}
