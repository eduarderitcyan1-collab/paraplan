<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service', function (Blueprint $table) {
            $table->id();
            $table->string('img')->nullable();
            $table->string('title');
            $table->string('desc');
            $table->unsignedInteger('price');
            $table->string('link')->nullable(); // если null — не показываем на фронте
            $table->integer('order'); // для сортировки
            $table->timestamps();
            $table->string('author')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service');
    }
};
