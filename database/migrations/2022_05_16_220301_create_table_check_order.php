<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCheckOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cheack_order', function (Blueprint $table) {
            $table->increments('id');
            $table->text('attach_docs');
            $table->text('attach_pictures_of_the_cargo');
            $table->text('signature');
            $table->string('date');
            $table->string('time');
            $table->string('location');
            $table->integer('order');
            $table->integer('driver');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cheack_order');
    }
}
