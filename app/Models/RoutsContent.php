<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RoutsContent extends Model
{
    use HasFactory;

    protected $table = 'routs_content';

    protected $fillable = [
        'routs_id',
        'title',
        'desc',
        'photo',
        'characteristics', // JSON
        'advantages',      // JSON
        'slug',
        'order',
    ];

    protected $casts = [
        'characteristics' => 'array',
        'advantages' => 'array',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'routs_id');
    }

    public function gallery()
    {
        return $this->hasMany(RoutsContentGallery::class, 'routs_content_id')
            ->orderBy('order');
    }

    // Scope для сортировки по полю order
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public static function boot()
    {
        parent::boot();

        // Генерация slug
        static::creating(function ($model) {
            if (!$model->slug) {
                $model->slug = Str::slug($model->title);
            }

            // Логика order
            if (!$model->order) {
                $maxOrder = self::where('routs_id', $model->routs_id)->max('order');
                $model->order = $maxOrder ? $maxOrder + 1 : 1;
            } else {
                self::where('routs_id', $model->routs_id)
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
                        self::where('routs_id', $model->routs_id)
                            ->where('order', '>', $oldOrder)
                            ->where('order', '<=', $newOrder)
                            ->decrement('order');
                    } else {
                        self::where('routs_id', $model->routs_id)
                            ->where('order', '>=', $newOrder)
                            ->where('order', '<', $oldOrder)
                            ->increment('order');
                    }
                }
            }
        });

        static::deleting(function ($model) {
            self::where('routs_id', $model->routs_id)
                ->where('order', '>', $model->order)
                ->decrement('order');
        });
    }
}