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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary(); // This table's ID remains uuid
            $table->string('user_id'); // This column definition is fine
            $table ->decimal('subtotal');
            $table ->decimal('discount')->default(0);
            $table ->string('name');
            $table ->string('phone');
            $table ->string('locality');
            $table ->text('address');
            $table ->string('city');
            $table ->string('state');
            $table ->string('country');
            $table ->string('landmark')->nullable();
            $table ->string('zip');
            $table ->string('type')->default('home');
            $table->enum('status', ['ordered', 'delivered', 'canceled'])->default('ordered');
            $table->boolean('is_shipping_different')->default(false);
            $table->date('delivered_date')->nullable();
            $table->date('canceled_date')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade'); // Changed 'id' to 'user_id'
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
