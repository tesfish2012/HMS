<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Booking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id', 36)->primary();
            $table->UUID('customer_id')->unique();
            $table->UUID('room_id')->unique();
            $table->datetime('date_from');
            $table->datetime('date_to');
            $table->string('remark')->nullable();
            $table->integer('state')->default(1);
            // $table->datetime('deleted_at')->nullable();
            $table->timestamps();
            $table->foreign('room_id')->references('id')->on('rooms');
            // $table->foreign('customer_id')->references('id')->on('customers');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
