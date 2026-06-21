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
    Schema::create('repairs', function (Blueprint $table) {

        $table->id();

        $table->foreignId('service_id')
              ->constrained('services')
              ->cascadeOnDelete();

        $table->foreignId('device_id')
              ->constrained('devices')
              ->cascadeOnDelete();

        $table->string('repair_name');

        $table->text('description')->nullable();

        $table->decimal('price', 10, 2);

        $table->string('warranty_period')->nullable();

        $table->string('duration')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
