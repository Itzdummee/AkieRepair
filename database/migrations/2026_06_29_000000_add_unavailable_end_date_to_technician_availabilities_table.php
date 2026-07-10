<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('technician_availabilities', 'unavailable_end_date')) {
            Schema::table('technician_availabilities', function (Blueprint $table) {
                $table->date('unavailable_end_date')->nullable()->after('unavailable_date');
            });
        }

        DB::table('technician_availabilities')
            ->whereNull('unavailable_end_date')
            ->update([
                'unavailable_end_date' => DB::raw('unavailable_date'),
            ]);
    }

    public function down(): void
    {
        if (Schema::hasColumn('technician_availabilities', 'unavailable_end_date')) {
            Schema::table('technician_availabilities', function (Blueprint $table) {
                $table->dropColumn('unavailable_end_date');
            });
        }
    }
};
