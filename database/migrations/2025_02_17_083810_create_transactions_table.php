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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary(); // This table's ID remains uuid
            $table->string('user_id'); // This column definition is fine
            $table->uuid('order_id'); // Remains uuid, references orders.id
            $table->enum('mode', ['cod', 'card']);
            $table->enum('status', ['pending', 'approved', 'declined', 'refunded'])->default('pending');
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade'); // Changed 'id' to 'user_id'
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
