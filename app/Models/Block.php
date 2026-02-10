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
        'name',
        'code',
        'schema',
        'display_order',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'schema' => 'array',
        'is_active' => 'boolean',
    ];

    public static function definitions(): array
    {
        return config('content.blocks', []);
    }

    public static function allowedCodes(): array
    {
        return array_keys(self::definitions());
    }

    public function definition(): ?array
    {
        return self::definitions()[$this->code] ?? null;
    }

    public function items(): HasMany
    {
        return $this->hasMany(BlockItem::class)->orderBy('display_order')->orderBy('id');
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
