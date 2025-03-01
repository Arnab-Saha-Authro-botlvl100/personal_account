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
         Schema::create('notes', function (Blueprint $table) {
             $table->id();
             $table->unsignedBigInteger('user'); // Assuming you're associating notes with users
             $table->string('title');
             $table->date('date');
             $table->text('description')->nullable();
             $table->enum('status', ['pending', 'completed'])->default('pending'); // Status of the note
             $table->timestamps();
 
         });
     }
 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
