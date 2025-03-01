<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // User's name
            $table->string('phone')->unique(); // User's phone (whatsapp)
            $table->string('email')->unique(); // User's email
            $table->string('address'); // User's address
            $table->string('password'); // User's password
            $table->timestamps(); // Created_at and Updated_at
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
