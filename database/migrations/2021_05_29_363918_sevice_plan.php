<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SevicePlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_plans', function (Blueprint $table) {
            $table->boolean('conversion')->charset('utf8')->collation('utf8_unicode_ci')->change();
            $table->uuid('id', 36)->primary();
            $table->UUID('service_id')->unique();
            $table->String('code')->unique();
            $table->String('name');
            $table->decimal('price');
            $table->String('description')->nullable();
            $table->String('featured_photo')->nullable();
            $table->integer('state')->default(1);
            // $table->datetime('deleted_at')->nullable();
            $table->timestamps();
            $table->foreign('service_id')->references('id')->on('service');
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
         Schema::dropIfExists('service_plan');
    }
}
