<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'type',
        'content',
        'display_order',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'content' => 'array',
    ];

    public static function allowedTypes(): array
    {
        return config('content.block_types', ['text']);
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(Media::class)->orderBy('display_order')->orderBy('id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
