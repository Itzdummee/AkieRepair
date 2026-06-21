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
    Schema::create('technician_availabilities', function (Blueprint $table) {
        $table->id();

        $table->string('technician_id');
        $table->foreign('technician_id')
            ->references('id')
            ->on('users')
            ->cascadeOnDelete();

        $table->date('unavailable_date');
        $table->string('reason')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technician_availabilities');
    }
};
