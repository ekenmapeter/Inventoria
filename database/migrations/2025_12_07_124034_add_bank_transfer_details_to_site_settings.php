<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('site_settings')->insert([
            ['key' => 'bank_account_name', 'value' => '', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'bank_account_number', 'value' => '', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'bank_name', 'value' => '', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'bank_routing_number', 'value' => '', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'subscription_amount', 'value' => '100.00', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Update payment_methods to remove mobile_money
        $currentMethods = DB::table('site_settings')->where('key', 'payment_methods')->first();
        if ($currentMethods) {
            $methods = json_decode($currentMethods->value, true);
            $methods = array_filter($methods, fn($m) => $m !== 'mobile_money');
            DB::table('site_settings')->where('key', 'payment_methods')->update([
                'value' => json_encode(array_values($methods))
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('site_settings')->whereIn('key', [
            'bank_account_name',
            'bank_account_number',
            'bank_name',
            'bank_routing_number',
            'subscription_amount'
        ])->delete();
    }
};
