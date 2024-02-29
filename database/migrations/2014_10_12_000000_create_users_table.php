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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('rol');
            $table->string('client_password');
            $table->string('name');
            $table->string('surname');
            $table->integer('phone');
            $table->string('mail')->unique();
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->string('CP');
            $table->date('registration_date');
            $table->string("image")->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
