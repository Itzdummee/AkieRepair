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
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('payment_status')->default('Pending')->after('quotation_status');
            $table->decimal('amount_paid', 10, 2)->nullable()->after('payment_status');
            $table->string('toyyibpay_bill_code')->nullable()->after('amount_paid');
            $table->timestamp('payment_date')->nullable()->after('toyyibpay_bill_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'amount_paid', 'toyyibpay_bill_code', 'payment_date']);
        });
    }
};
