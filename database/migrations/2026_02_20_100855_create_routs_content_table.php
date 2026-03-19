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
        Schema::create('routs_content', function (Blueprint $table) {
            $table->id();
            $table->foreignId('routs_id')
                  ->constrained('routes')
                  ->cascadeOnDelete(); // связь с таблицей routes
            $table->string('title');
            $table->text('desc')->nullable();
            $table->string('photo')->nullable();
            $table->json('characteristics')->nullable(); // характеристики маршрута
            $table->json('advantages')->nullable(); // преимущества
            $table->string('slug')->unique(); // для латиницы
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routs_content');
    }
};