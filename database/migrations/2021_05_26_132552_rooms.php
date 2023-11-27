<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rooms extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('featured_photo')->nullable();
            $table->datetime('deleted_at')->nullable();
            $table->integer('state')->default(1);
            $table->timestamps();
        });

        Schema::create('rooms', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('name')->unique();
            $table->string('category_id', 36);
            $table->string('bed_type');
            // $table->datetime('deleted_at')->nullable();
            $table->integer('state')->default(1);
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('categories');
    }
}
