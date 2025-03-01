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
        Schema::create('previous_dues', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['agent', 'supplier']);
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->decimal('amount', 10, 2);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('previous_dues');
    }
};
