<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleGallery extends Model
{
    protected $table = 'article_galleries';
    use HasFactory;

    protected $fillable = [
        'article_id',
        'path',
        'order',
    ];

    /**
     * Scope сортировки
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->order) {
                $maxOrder = self::where('article_id', $model->article_id)->max('order');
                $model->order = $maxOrder ? $maxOrder + 1 : 1;
            } else {
                self::where('article_id', $model->article_id)
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
                        self::where('article_id', $model->article_id)
                            ->where('order', '>', $oldOrder)
                            ->where('order', '<=', $newOrder)
                            ->decrement('order');
                    } else {
                        self::where('article_id', $model->article_id)
                            ->where('order', '>=', $newOrder)
                            ->where('order', '<', $oldOrder)
                            ->increment('order');
                    }
                }
            }
        });

        static::deleting(function ($model) {
            self::where('article_id', $model->article_id)
                ->where('order', '>', $model->order)
                ->decrement('order');
        });
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}