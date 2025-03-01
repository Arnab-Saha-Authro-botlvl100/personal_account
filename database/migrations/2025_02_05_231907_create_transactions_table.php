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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('transaction_type', ['cash', 'bank']); // Type of transaction
            $table->decimal('amount', 10, 2)->nullable(); // Transaction amount
            $table->string('description')->nullable(); // Description of the transaction
            $table->string('bank_name')->nullable(); // Bank name (nullable for cash transactions)
            $table->string('account_number', 12)->nullable(); // Account number (nullable for cash transactions)
            $table->string('branch_name')->nullable(); // Branch name (nullable for cash transactions)
            $table->decimal('opening_balance', 10, 2)->nullable(); // Opening balance (nullable for cash transactions)
            $table->integer('user');
            $table->integer('is_delete')->default(0);
            $table->timestamps(); // Created at and updated at timestamps
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
