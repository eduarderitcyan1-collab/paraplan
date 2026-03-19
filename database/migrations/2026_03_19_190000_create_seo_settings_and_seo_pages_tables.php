<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_global_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('global_indexing_enabled')->default(true);
            $table->timestamps();
        });

        Schema::create('seo_page_rules', function (Blueprint $table) {
            $table->id();
            $table->string('url', 2048);
            $table->string('normalized_url', 255)->unique();
            $table->boolean('indexing_enabled')->default(true);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('canonical_url', 2048)->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image_path')->nullable();
            $table->string('og_image_alt')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_page_rules');
        Schema::dropIfExists('seo_global_settings');
    }
};
