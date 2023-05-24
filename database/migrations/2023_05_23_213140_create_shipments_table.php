<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('shipments');
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('container_number')->unique();
            $table->string('booking_ref')->unique();
            $table->string('booking_number')->unique();
            $table->unsignedBigInteger('shipper_id');
            $table->unsignedBigInteger('transitor_id');
            $table->unsignedBigInteger('destination_port_id');
            $table->unsignedBigInteger('loading_port_id');
            $table->string("vessel_name")->nullable()->default('missing');
            $table->date('etd')->nullable();
            $table->date('eta')->nullable();
            $table->string('seal_number')->unique()->nullable()->default('missing');
            $table->timestamps();

            $table->foreign('shipper_id')->references('id')->on('parties');
            $table->foreign('transitor_id')->references('id')->on('parties');
            $table->foreign('destination_port_id')->references('id')->on('ports');
            $table->foreign('loading_port_id')->references('id')->on('ports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
};
