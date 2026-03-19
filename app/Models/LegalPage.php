<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalPage extends Model
{
    use HasFactory;

    public const KEY_PRIVACY = 'privacy_policy';
    public const KEY_CONSENT = 'personal_data_consent';

    protected $fillable = [
        'key',
        'title',
        'content',
    ];

    public static function forKey(string $key)
    {
        return self::query()->where('key', $key)->first();
    }
}
