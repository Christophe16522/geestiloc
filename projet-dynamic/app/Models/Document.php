<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    protected $fillable = [
        'user_id', 'property_id', 'name', 'category',
        'upload_date', 'expiration_date', 'file_path', 'file_size', 'mime_type',
    ];

    protected $casts = [
        'upload_date'     => 'date',
        'expiration_date' => 'date',
    ];

    // Relations
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function property(): BelongsTo { return $this->belongsTo(Property::class); }

    // Scopes
    public function scopeByCategory($q, string $category) { return $q->where('category', $category); }
    public function scopeExpiringSoon($q, int $days = 30)
    {
        return $q->whereNotNull('expiration_date')
                 ->whereDate('expiration_date', '<=', now()->addDays($days))
                 ->whereDate('expiration_date', '>=', now());
    }

    // Accessors
    public function getFileSizeFormattedAttribute(): string
    {
        if ($this->file_size < 1024) return $this->file_size . ' o';
        if ($this->file_size < 1024 * 1024) return round($this->file_size / 1024, 1) . ' Ko';
        return round($this->file_size / (1024 * 1024), 1) . ' Mo';
    }

    public function getIsExpiredAttribute(): bool
    {
        return $this->expiration_date && $this->expiration_date->isPast();
    }
}
