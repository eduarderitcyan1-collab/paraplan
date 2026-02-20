<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'published_at',
        'order',
    ];

    // кастим published_at в Carbon, без времени
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Связь с фотографиями
     */
    public function photos()
    {
        return $this->hasMany(ReviewPhoto::class);
    }

    /**
     * Scope сортировки
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Accessor для удобного формата даты
     */
    public function getPublishedAtFormattedAttribute()
    {
        return $this->published_at ? Carbon::parse($this->published_at)->format('d.m.Y') : null;
    }

    protected static function boot()
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

            // авто-дата публикации
            if (!$model->published_at) {
                $model->published_at = now();
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
