<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->date('flight_date');
            $table->string('airline');
            $table->string('pnr_no');
            $table->string('ticket_no');
            $table->string('flight_no');
            $table->string('sector');
            $table->string('class');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->boolean('baggage')->default(false);
            $table->enum('food', ['yes', 'no'])->default('no');
            $table->tinyInteger('is_delete')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->unsignedBigInteger('user');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}