<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatiGallery extends Model
{
    use HasFactory;

    protected $table = 'stati_gallery';

    protected $fillable = [
        'stati_id',
        'path',
        'order',
    ];

    /**
     * Scope для сортировки по order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Boot модель для авто-назначения order
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->order) {
                $maxOrder = self::where('stati_id', $model->stati_id)->max('order');
                $model->order = $maxOrder ? $maxOrder + 1 : 1;
            } else {
                self::where('stati_id', $model->stati_id)
                    ->where('order', '>=', $model->order)
                    ->increment('order');
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('order')) {
                $oldOrder = $model->getOriginal('order');
                $newOrder = $model->order;

                if ($oldOrder != $newOrder) {
                    if ($newOrder > $oldOrder) {
                        self::where('stati_id', $model->stati_id)
                            ->where('order', '>', $oldOrder)
                            ->where('order', '<=', $newOrder)
                            ->decrement('order');
                    } else {
                        self::where('stati_id', $model->stati_id)
                            ->where('order', '>=', $newOrder)
                            ->where('order', '<', $oldOrder)
                            ->increment('order');
                    }
                }
            }
        });

        static::deleting(function ($model) {
            self::where('stati_id', $model->stati_id)
                ->where('order', '>', $model->order)
                ->decrement('order');
        });
    }

    /**
     * Связь с основной статьей
     */
    public function stati()
    {
        return $this->belongsTo(Stati::class, 'stati_id');
    }
}