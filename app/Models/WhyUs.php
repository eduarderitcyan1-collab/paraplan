<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyUs extends Model
{
    use HasFactory;

    protected $table = 'why_us';

    protected $fillable = [
        'svg',
        'title',
        'desc',
        'order',
    ];

    // Scope для сортировки по order
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Назначаем уникальный порядок перед созданием.
     */
    public static function boot()
    {
        parent::boot();

        // При создании новой записи
        static::creating(function ($model) {
            if (!$model->order) {
                $maxOrder = self::max('order');
                $model->order = $maxOrder ? $maxOrder + 1 : 1;
            } else {
                // Если указан order, сдвигаем остальные записи
                self::where('order', '>=', $model->order)->increment('order');
            }
        });

        // При обновлении записи
        static::updating(function ($model) {
            if ($model->isDirty('order')) {
                $oldOrder = $model->getOriginal('order');
                $newOrder = $model->order;

                if ($oldOrder != $newOrder) {
                    if ($newOrder > $oldOrder) {
                        // Сдвигаем вниз записи между old и new
                        self::where('order', '>', $oldOrder)
                            ->where('order', '<=', $newOrder)
                            ->decrement('order');
                    } else {
                        // Сдвигаем вверх записи между new и old
                        self::where('order', '>=', $newOrder)
                            ->where('order', '<', $oldOrder)
                            ->increment('order');
                    }
                }
            }
        });

        // При удалении записи
        static::deleting(function ($model) {
            self::where('order', '>', $model->order)->decrement('order');
        });
    }
}
