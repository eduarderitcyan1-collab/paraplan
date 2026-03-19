<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    use HasFactory;

    protected $table = 'seo_global_settings';

    protected $fillable = [
        'global_indexing_enabled',
        'favicon_path',
    ];

    protected $casts = [
        'global_indexing_enabled' => 'boolean',
    ];
}
