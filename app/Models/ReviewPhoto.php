<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'review_id',
        'path',
        'order',
    ];

    /**
     * Связь с отзывом
     */
    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    /**
     * Scope сортировки
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    protected static function boot()
    {
        parent::boot();

        // Создание
        static::creating(function ($model) {
            if (!$model->order) {
                $maxOrder = self::where('review_id', $model->review_id)->max('order');
                $model->order = $maxOrder ? $maxOrder + 1 : 1;
            } else {
                self::where('review_id', $model->review_id)
                    ->where('order', '>=', $model->order)
                    ->increment('order');
            }
        });

        // Обновление
        static::updating(function ($model) {
            if ($model->isDirty('order')) {
                $oldOrder = $model->getOriginal('order');
                $newOrder = $model->order;

                if ($oldOrder != $newOrder) {
                    if ($newOrder > $oldOrder) {
                        self::where('review_id', $model->review_id)
                            ->where('order', '>', $oldOrder)
                            ->where('order', '<=', $newOrder)
                            ->decrement('order');
                    } else {
                        self::where('review_id', $model->review_id)
                            ->where('order', '>=', $newOrder)
                            ->where('order', '<', $oldOrder)
                            ->increment('order');
                    }
                }
            }
        });

        // Удаление
        static::deleting(function ($model) {
            self::where('review_id', $model->review_id)
                ->where('order', '>', $model->order)
                ->decrement('order');
        });
    }
}
