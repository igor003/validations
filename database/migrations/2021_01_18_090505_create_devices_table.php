<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_type');
            $table->string('number', 50);
            $table->string('serial_number', 50);
            $table->string('inventory_number', 50);
            $table->string('maker', 50);
            $table->string('model', 50);
            $table->string('status', 50);
            $table->date('start_date')->nullable();
            $table->date('next_valid_date')->nullable();

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
        Schema::dropIfExists('devices');
    }
}
