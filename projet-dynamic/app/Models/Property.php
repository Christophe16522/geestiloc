<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    protected $fillable = [
        'user_id', 'reference', 'name', 'address', 'city', 'postal_code',
        'type', 'surface_m2', 'monthly_rent', 'charges', 'deposit', 'status', 'description',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (self $property) {
            if (empty($property->reference)) {
                $last = self::max('id') ?? 0;
                $property->reference = 'PROP-' . str_pad($last + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    // Relations
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function tenants(): HasMany { return $this->hasMany(Tenant::class); }
    public function contracts(): HasMany { return $this->hasMany(Contract::class); }
    public function payments(): HasMany { return $this->hasMany(Payment::class); }
    public function documents(): HasMany { return $this->hasMany(Document::class); }
    public function maintenances(): HasMany { return $this->hasMany(Maintenance::class); }

    // Scopes
    public function scopeOccupee($q) { return $q->where('status', 'occupee'); }
    public function scopeVacante($q) { return $q->where('status', 'vacante'); }
    public function scopeByCity($q, string $city) { return $q->where('city', $city); }
    public function scopeByType($q, string $type) { return $q->where('type', $type); }

    // Accessors
    public function getFullAddressAttribute(): string
    {
        return trim($this->address . ', ' . $this->postal_code . ' ' . $this->city);
    }

    public function getOccupancyRateAttribute(): float
    {
        // Simple: 100% if occupied, 0% if vacant
        return $this->status === 'occupee' ? 100.0 : 0.0;
    }
}
