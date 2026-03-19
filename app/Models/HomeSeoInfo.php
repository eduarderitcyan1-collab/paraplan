<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSeoInfo extends Model
{
    use HasFactory;

    protected $table = 'home_seo_info';

    protected $fillable = [
        'title',
        'desc',
    ];
}
