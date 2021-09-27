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
            $table->integer('price_s');
            $table->integer('diskon_dpp_s');
            $table->integer('markup_s');
            $table->integer('price_asuransi_s');
            $table->integer('diskon_asuransi_s');
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
