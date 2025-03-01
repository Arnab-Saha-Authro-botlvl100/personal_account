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
        Schema::create('customer_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade'); // Foreign key linking to customers table
            $table->date('passport_issue_date')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('medical_name')->nullable();
            $table->date('medical_issue_date')->nullable();
            $table->string('medical_status')->nullable();
            $table->string('mofa_no')->nullable();
            $table->date('mofa_date')->nullable();
            $table->date('biomatrics_date')->nullable();
            $table->string('biomatric_status')->nullable();
            $table->string('police_clearance_no')->nullable();
            $table->string('visa_no')->nullable();
            $table->string('training_info')->nullable();
            $table->date('visa_stemping_date')->nullable();
            $table->date('bmet_finger')->nullable();
            $table->date('manpower_date')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers_deails');
    }
};
