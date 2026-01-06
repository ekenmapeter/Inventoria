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
            $table->foreignId('package_id')->nullable()->constrained()->onDelete('set null')->after('type');
            $table->dropColumn('type');
            $table->enum('type', ['monthly_due', 'subscription', 'fundraise'])->default('monthly_due')->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['package_id']);
            $table->dropColumn('package_id');
            $table->dropColumn('type');
            $table->enum('type', ['monthly_due', 'subscription'])->default('monthly_due')->after('amount');
        });
    }
};
