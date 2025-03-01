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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('invoice_no'); // Unique invoice number
            $table->decimal('profit')->nullable(); // Details of the contract
            $table->date('date'); // Start date of the contract
            $table->string('agent'); // Agent's name or ID
            $table->decimal('agent_price', 10, 2); // Price associated with the agent
            $table->string('supplier'); // Supplier's name or ID
            $table->decimal('supplier_price', 10, 2); // Price associated with the supplier
            $table->integer('user');
            $table->integer('customer_id');
            $table->timestamps(); // Created at and updated at timestamps
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
