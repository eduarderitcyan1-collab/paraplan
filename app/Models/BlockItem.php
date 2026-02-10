<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlockItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_id',
        'title',
        'subtitle',
        'description',
        'payload',
        'display_order',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class);
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
