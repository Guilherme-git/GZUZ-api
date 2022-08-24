<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDataOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('load')->nullable();
            $table->text('image')->nullable();
            $table->longText('base64')->nullable();
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->string('depth')->nullable();
            $table->string('weight')->nullable();
            $table->string('inchOrCentimeter')->nullable();
            $table->string('lbsOrKgs')->nullable();
            $table->integer('order_details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_order_details');
    }
}
