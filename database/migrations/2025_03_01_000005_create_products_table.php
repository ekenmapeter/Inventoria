<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('supplier_id')->constrained()->cascadeOnDelete();
            $table->foreignId('location_id')->constrained()->cascadeOnDelete();

            $table->string('item_code')->unique();
            $table->text('description');
            $table->string('sub_category')->nullable();
            $table->decimal('purchase_cost', 10, 2);
            $table->decimal('sales_price', 10, 2);
            $table->string('unit_measure');
            $table->integer('quantity')->default(0);
            $table->integer('ideal_quantity')->nullable();
            $table->integer('warn_quantity')->nullable();
            $table->string('supplier_part_number')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
