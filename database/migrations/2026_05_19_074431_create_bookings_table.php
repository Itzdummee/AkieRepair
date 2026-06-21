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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();

        $table->string('customer_id');
        $table->foreign('customer_id')->references('id')->on('users')->cascadeOnDelete();

        $table->foreignId('device_id')->constrained()->cascadeOnDelete();

        $table->string('technician_id')->nullable();
        $table->foreign('technician_id')->references('id')->on('users')->nullOnDelete();

        $table->text('problem_description');
        $table->date('visit_date')->nullable();

        $table->text('inspection_report')->nullable();

        $table->decimal('quotation_price', 10, 2)->nullable();
        $table->text('quotation_note')->nullable();
        $table->string('quotation_status')->nullable();

        $table->date('pickup_date')->nullable();

        $table->string('status')->default('Visit Requested');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
