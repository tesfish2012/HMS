<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Payments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {      
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('payment_receipt_id', 36)->primary();
            $table->UUID('customer_id')->unique();
            $table->String('amount');
            $table->datetime('paid_at');
            $table->integer('state')->default(1);
            // $table->datetime('deleted_at')->nullable();
            $table->timestamps();
            // $table->foreign('payment_receipt_id')->references('id')->on('payment_receipts');
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
        Schema::dropIfExists('payments');
    }
}
