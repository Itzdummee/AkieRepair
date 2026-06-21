<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ADD service_id ONLY if not exists
        if (!Schema::hasColumn('repairs', 'service_id')) {
            Schema::table('repairs', function (Blueprint $table) {
                $table->foreignId('service_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('services')
                    ->nullOnDelete();
            });
        }

        // RENAME repair_name to repair_type ONLY if repair_name exists
        if (Schema::hasColumn('repairs', 'repair_name') && !Schema::hasColumn('repairs', 'repair_type')) {
            Schema::table('repairs', function (Blueprint $table) {
                $table->renameColumn('repair_name', 'repair_type');
            });
        }

        // ADD image ONLY if not exists
        if (!Schema::hasColumn('repairs', 'image')) {
            Schema::table('repairs', function (Blueprint $table) {
                $table->string('image')->nullable()->after('duration');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('repairs', 'image')) {
            Schema::table('repairs', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }

        if (Schema::hasColumn('repairs', 'repair_type') && !Schema::hasColumn('repairs', 'repair_name')) {
            Schema::table('repairs', function (Blueprint $table) {
                $table->renameColumn('repair_type', 'repair_name');
            });
        }

        if (Schema::hasColumn('repairs', 'service_id')) {
            Schema::table('repairs', function (Blueprint $table) {
                $table->dropConstrainedForeignId('service_id');
            });
        }
    }
};