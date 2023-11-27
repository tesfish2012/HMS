<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PaymentReceipts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {      
        Schema::create('payment_receipts', function (Blueprint $table) {
            $table->uuid('id', 36)->primary();
            $table->UUID('customer_service_log_id')->unique();
            $table->String('customer_name');
            $table->String('service_name');
            $table->String('amount');
            $table->datetime('to_be_paid_at');
            $table->datetime('paid_at');
            $table->integer('state')->default(1);
            // $table->datetime('deleted_at')->nullable();
            $table->timestamps();
            // $table->foreign('customer_service_log_id')->references('id')->on('customer_service_logs');
            // $table->foreign('customer_name')->references('id')->on('customers');
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
      Schema::dropIfExists('payment_receipts');
    }
}
