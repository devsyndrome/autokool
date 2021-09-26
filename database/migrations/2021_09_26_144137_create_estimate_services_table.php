<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimate_services', function (Blueprint $table) {
            $table->increments('id_services');
            $table->integer('id_estimate')->index();
            $table->string('jasa');
            $table->string('note');
            $table->integer('qty');
            $table->integer('pricejasa');
            $table->char('status_hpp');
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
        Schema::dropIfExists('estimate_services');
    }
}
