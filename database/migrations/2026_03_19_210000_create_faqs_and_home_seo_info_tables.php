<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faqs', function (Blueprint $table): void {
            $table->id();
            $table->string('title', 255);
            $table->longText('desc');
            $table->unsignedInteger('order')->default(0)->index();
            $table->timestamps();
        });

        Schema::create('home_seo_info', function (Blueprint $table): void {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->longText('desc')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_seo_info');
        Schema::dropIfExists('faqs');
    }
};
