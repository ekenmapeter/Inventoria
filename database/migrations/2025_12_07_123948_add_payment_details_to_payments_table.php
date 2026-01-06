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
        Schema::table('payments', function (Blueprint $table) {
            $table->enum('type', ['monthly_due', 'subscription'])->default('monthly_due')->after('amount');
            $table->string('payment_method')->nullable()->after('type');
            $table->string('payment_proof')->nullable()->after('payment_method');
            $table->text('notes')->nullable()->after('payment_proof');
            $table->timestamp('approved_at')->nullable()->after('admin_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['type', 'payment_method', 'payment_proof', 'notes', 'approved_at']);
        });
    }
};
