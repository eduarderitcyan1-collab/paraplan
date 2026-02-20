<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'team';

    protected $fillable = [
        'img',
        'title',
        'desc',
        'order',
    ];

    /**
     * Scope для сортировки по order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public static function boot()
    {
        parent::boot();

        // Создание
        static::creating(function ($model) {
            if (!$model->order) {
                $maxOrder = self::max('order');
                $model->order = $maxOrder ? $maxOrder + 1 : 1;
            } else {
                self::where('order', '>=', $model->order)->increment('order');
            }
        });

        // Обновление
        static::updating(function ($model) {
            if ($model->isDirty('order')) {
                $oldOrder = $model->getOriginal('order');
                $newOrder = $model->order;

                if ($oldOrder != $newOrder) {
                    if ($newOrder > $oldOrder) {
                        self::where('order', '>', $oldOrder)
                            ->where('order', '<=', $newOrder)
                            ->decrement('order');
                    } else {
                        self::where('order', '>=', $newOrder)
                            ->where('order', '<', $oldOrder)
                            ->increment('order');
                    }
                }
            }
        });

        // Удаление
        static::deleting(function ($model) {
            self::where('order', '>', $model->order)->decrement('order');
        });
    }
}
