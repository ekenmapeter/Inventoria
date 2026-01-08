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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, image, json
            $table->timestamps();
        });

        // Insert default settings
        \Illuminate\Support\Facades\DB::table('site_settings')->insert([
            ['key' => 'site_name', 'value' => config('app.name', 'Laravel'), 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_logo', 'value' => null, 'type' => 'image', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'smtp_host', 'value' => config('mail.mailers.smtp.host'), 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'smtp_port', 'value' => config('mail.mailers.smtp.port'), 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'smtp_username', 'value' => config('mail.mailers.smtp.username'), 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'smtp_password', 'value' => config('mail.mailers.smtp.password'), 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'smtp_encryption', 'value' => config('mail.mailers.smtp.encryption'), 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'smtp_from_address', 'value' => config('mail.from.address'), 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'smtp_from_name', 'value' => config('mail.from.name'), 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'monthly_dues_amount', 'value' => '50.00', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'payment_methods', 'value' => json_encode(['bank_transfer', 'cash', 'mobile_money']), 'type' => 'json', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'auto_suspend_days', 'value' => '30', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
