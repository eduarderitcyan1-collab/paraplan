<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'preview',
        'is_active',
        'border_color',
    ];

    // Связь с медиа
    public function media()
    {
        return $this->hasMany(StoryMedia::class);
    }
}
