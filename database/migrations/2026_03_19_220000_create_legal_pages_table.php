<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('legal_pages', function (Blueprint $table): void {
            $table->id();
            $table->string('key', 100)->unique();
            $table->string('title', 255);
            $table->longText('content');
            $table->timestamps();
        });

        // Создаем начальные записи, чтобы страницы сразу работали
        Schema::table('legal_pages', function (Blueprint $table) {
            // nop
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('legal_pages');
    }
};
