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
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade'); 
            $table->date('date_order');
            $table->date('date_out')->nullable();
            $table->date('date_delivered')->nullable();
            $table->string('payment_method');
            $table->string('state'); //preparing, sending, delivered
            $table->string('pay_state'); //outstanding, paid, refused
            $table->string('address'); //calle, ciudad, estado/provincia, código postal, y país.
            $table->string('clients_note');
            $table->decimal('additional_cost');
            $table->string('transaction_id');
            $table->timestamps();
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
