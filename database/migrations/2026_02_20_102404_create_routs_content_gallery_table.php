<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('routs_content_gallery', function (Blueprint $table) {
            $table->id();
            $table->foreignId('routs_content_id')
                  ->constrained('routs_content')
                  ->cascadeOnDelete(); // связь с таблицей routs_content
            $table->string('path'); // путь к фото
            $table->integer('order')->default(0); // порядок сортировки
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routs_content_gallery');
    }
};