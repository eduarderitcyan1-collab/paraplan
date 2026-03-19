<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('story_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('story_id')->constrained('stories')->cascadeOnDelete();
            $table->enum('type', ['photo', 'video']);
            $table->string('path');
            $table->unsignedInteger('sort')->nullable()->default(null);
            $table->timestamps();

            $table->index(['story_id', 'type']); // индекс для быстрого поиска
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('story_media');
    }
};
