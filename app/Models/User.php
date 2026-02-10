<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function blocksCreated(): HasMany
    {
        return $this->hasMany(Block::class, 'created_by');
    }

    public function blockItemsCreated(): HasMany
    {
        return $this->hasMany(BlockItem::class, 'created_by');
    }

    public function galleryItemsCreated(): HasMany
    {
        return $this->hasMany(GalleryItem::class, 'created_by');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
