<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimate_parts', function (Blueprint $table) {
            $table->increments('id_part');
            $table->integer('id_estimate')->index();
            $table->char('nopart');
            $table->string('sparepart');
            $table->integer('qty');
            $table->integer('pricepart');
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
        Schema::dropIfExists('estimate_parts');
    }
}
