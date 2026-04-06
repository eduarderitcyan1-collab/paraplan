<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('redirect_rules')) {
            Schema::create('redirect_rules', function (Blueprint $table) {
                $table->id();
                // 512 * 4 = 2048 bytes, безопасно для utf8mb4 unique index.
                $table->string('from_url', 512)->unique();
                $table->string('to_url', 1024);
                $table->unsignedSmallInteger('status_code')->default(301);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });

            return;
        }

        // Если таблица уже появилась после неудачной миграции, приводим схему к корректному виду.
        DB::statement('ALTER TABLE `redirect_rules` MODIFY `from_url` VARCHAR(512) NOT NULL');

        $hasUniqueIndex = DB::table('information_schema.statistics')
            ->where('table_schema', DB::getDatabaseName())
            ->where('table_name', 'redirect_rules')
            ->where('index_name', 'redirect_rules_from_url_unique')
            ->exists();

        if (! $hasUniqueIndex) {
            DB::statement('ALTER TABLE `redirect_rules` ADD UNIQUE `redirect_rules_from_url_unique` (`from_url`)');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redirect_rules');
    }
};
