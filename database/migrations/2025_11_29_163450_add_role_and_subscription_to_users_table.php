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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'moderator', 'user'])->default('user')->after('email');
            $table->enum('subscription_status', ['active', 'pending', 'expired', 'cancelled'])->default('pending')->after('role');
            $table->timestamp('suspended_until')->nullable()->after('subscription_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'subscription_status', 'suspended_until']);
        });
    }
};
