<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ServiceSubscription extends Migration
{  /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_subscriptions', function (Blueprint $table) {
            $table->uuid('id', 36)->primary();
            $table->UUID('customer_id')->unique();
            $table->UUID('service_id')->unique();
            $table->UUID('service_plan_id')->unique();
            $table->datetime('date_from');
            $table->datetime('date_to');
            $table->integer('payment_state')->default(0);//(0: unpaid, 1:paid)
            $table->String('remark')->nullable();
            // $table->datetime('deleted_at')->nullable();
            $table->integer('state')->default(0);
            $table->timestamps();
            // $table->foreign('service_id')->references('id')->on('service');
            // $table->foreign('service_plan_id')->references('id')->on('service_plans');
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
         Schema::dropIfExists('service_subscriptions');
    }
}
