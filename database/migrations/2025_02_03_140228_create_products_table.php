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
        Schema::create('products', function (Blueprint $table) {
            $table->string('product_id')->primary(); // Changed from 'id'
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('short_description');
            $table->text('description');
            $table->decimal('regular_price');
            $table->decimal('sale_price')->nullable;
            $table->string('SKU');
            $table->enum('stock_status',['instock','outofstock']);
            $table->boolean('featured')->default(false);
            $table->unsignedinteger('quantity')->default(10);
            $table->string('image')->nullable();
            $table->text('images')->nullable();
            $table->string('category_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade'); // Changed 'id' to 'category_id'
            $table->foreign('brand_id')->references('brand_id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
