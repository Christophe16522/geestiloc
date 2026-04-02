<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maintenance extends Model
{
    protected $fillable = [
        'user_id', 'property_id', 'title', 'description',
        'priority', 'estimated_cost', 'actual_cost',
        'progress_percentage', 'status', 'started_at', 'completed_at',
    ];

    protected $casts = [
        'started_at'   => 'datetime',
        'completed_at' => 'datetime',
    ];

    // Relations
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function property(): BelongsTo { return $this->belongsTo(Property::class); }

    // Scopes
    public function scopeAFaire($q) { return $q->where('status', 'a_faire'); }
    public function scopeEnCours($q) { return $q->where('status', 'en_cours'); }
    public function scopeTermine($q) { return $q->where('status', 'termine'); }
    public function scopeByPriority($q, string $priority) { return $q->where('priority', $priority); }
    public function scopeUrgent($q) { return $q->where('priority', 'haute')->where('status', '!=', 'termine'); }

    // Accessors
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'a_faire'  => 'À faire',
            'en_cours' => 'En cours',
            'termine'  => 'Terminé',
            default    => $this->status,
        };
    }

    public function getPriorityColorAttribute(): string
    {
        return match($this->priority) {
            'haute'   => 'danger',
            'moyenne' => 'warning',
            'basse'   => 'success',
            default   => 'secondary',
        };
    }
}
