<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Activitylog\Traits\LogsActivity;

class Document extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, LogsActivity;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'document_type',
        'document_number',
        'issue_date',
        'expiration_date',
        'is_favorite',
        'is_archived',
        'metadata',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiration_date' => 'date',
        'is_favorite' => 'boolean',
        'is_archived' => 'boolean',
        'metadata' => 'array',
    ];

    protected static $logAttributes = ['title', 'document_type', 'is_favorite', 'is_archived'];
    protected static $logOnlyDirty = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_archived', false);
    }

    public function scopeFavorite($query)
    {
        return $query->where('is_favorite', true);
    }

    public function scopeExpiringSoon($query, $days = 30)
    {
        return $query->where('expiration_date', '>=', now())
            ->where('expiration_date', '<=', now()->addDays($days));
    }

    public function scopeExpired($query)
    {
        return $query->where('expiration_date', '<', now());
    }

    public function getDaysUntilExpirationAttribute(): ?int
    {
        if (!$this->expiration_date) {
            return null;
        }

        return (int) now()->diffInDays($this->expiration_date, false);
    }
}