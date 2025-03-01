<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id'); // Unique invoice number
            $table->unsignedBigInteger('user');
            $table->string('name');
            $table->string('phone_number');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->unsignedBigInteger('agent_contract');
            $table->unsignedBigInteger('supplier_contract');
            $table->string('passport_file');
            $table->string('nid_file');
            $table->text('note')->nullable();
            $table->string('passport_number');
            $table->unsignedBigInteger('agent');
            $table->unsignedBigInteger('supplier');
            $table->unsignedBigInteger('service');
            $table->date('passport_expiry_date');
            $table->string('country_of_residence')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('country')->nullable();
            $table->unsignedBigInteger('contract_id')->nullable();
            $table->boolean('is_delete')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
