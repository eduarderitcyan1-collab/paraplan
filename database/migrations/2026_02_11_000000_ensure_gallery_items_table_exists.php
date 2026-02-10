<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Fix for environments where old migrations were applied before `gallery_items` was introduced.
        if (! Schema::hasTable('gallery_items')) {
            Schema::create('gallery_items', function (Blueprint $table): void {
                $table->id();
                $table->enum('type', ['photo', 'video']);
                $table->string('url');
                $table->string('preview_url')->nullable();
                $table->string('title')->nullable();
                $table->unsignedInteger('display_order')->default(0);
                $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
                $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
                $table->timestamps();
            });

            return;
        }

        Schema::table('gallery_items', function (Blueprint $table): void {
            if (! Schema::hasColumn('gallery_items', 'preview_url')) {
                $table->string('preview_url')->nullable()->after('url');
            }
            if (! Schema::hasColumn('gallery_items', 'display_order')) {
                $table->unsignedInteger('display_order')->default(0)->after('title');
            }
        });
    }

    public function down(): void
    {
        // no-op to avoid destructive rollback in existing installations
    }
};
