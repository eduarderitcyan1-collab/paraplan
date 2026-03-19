<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'body',
        'media_type',
        'media_path',
        'media_alt',
        'order',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('id', 'asc');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->order === null) {
                $maxOrder = self::max('order');
                $model->order = $maxOrder === null ? 1 : $maxOrder + 1;
            } else {
                self::where('order', '>=', $model->order)->increment('order');
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('order')) {
                $oldOrder = (int) $model->getOriginal('order');
                $newOrder = (int) $model->order;

                if ($oldOrder !== $newOrder) {
                    if ($newOrder > $oldOrder) {
                        self::where('id', '!=', $model->id)
                            ->where('order', '>', $oldOrder)
                            ->where('order', '<=', $newOrder)
                            ->decrement('order');
                    } else {
                        self::where('id', '!=', $model->id)
                            ->where('order', '>=', $newOrder)
                            ->where('order', '<', $oldOrder)
                            ->increment('order');
                    }
                }
            }
        });

        static::deleting(function ($model) {
            self::where('order', '>', $model->order)->decrement('order');
        });
    }
}
