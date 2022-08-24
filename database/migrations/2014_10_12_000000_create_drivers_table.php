<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('transporter');
            $table->string('phone');
            $table->string('email');
            $table->string('position');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->text('zip');
            $table->integer('status');
            $table->string('vehicle');
            $table->integer('vehicle_status');
            $table->string('password');
            $table->text('latitude');
            $table->text('longitude');
            $table->text('document_driver_license');
            $table->text('document_vehicle_insurance');
            $table->text('sta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
