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
        Schema::create('receives', function (Blueprint $table) {
            $table->id();
            $table->date('date'); // Date of the transaction
            $table->enum('receive_type', ['customer', 'others']); // Type of receive
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('set null'); // Customer ID (nullable for 'others')
            $table->string('customer_name')->nullable(); // Customer name (if needed)
            $table->string('contract_invoice')->nullable(); // Contract invoice (if needed)
            $table->string('receive_amount')->nullable(); // Agent contract (if needed)
            $table->enum('transaction_method', ['cash', 'bank']); // Transaction method
            $table->string('bank_name')->nullable(); // Bank name (nullable for cash transactions)
            $table->string('account_number')->nullable(); // Account number (nullable for cash transactions)
            $table->string('branch_name')->nullable(); // Branch name (nullable for cash transactions)
            $table->decimal('amount', 10, 2); // Amount received
            $table->text('note')->nullable(); // Additional notes
            $table->integer('user');
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receives');
    }
};
