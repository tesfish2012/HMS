<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Testimonial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('testimonials', function (Blueprint $table) {
        $table->UUID('id', 36)->primary();
        $table->string('name');
        $table->string('position'); 
        $table->string('quoted_text')->nullable();
        $table->string('body')->nullable();
        // $table->datetime('deleted_at')->nullable();
        $table->integer('state')->default(1);
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
       Schema::dropIfExists('testimonial');
    }
}
