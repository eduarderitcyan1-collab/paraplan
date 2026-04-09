<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Road extends Model
{
    use HasFactory;

    // Разрешенные для массового заполнения поля
    protected $fillable = [
        'title',
        'desc',
        'video',
        'map',
    ];
}