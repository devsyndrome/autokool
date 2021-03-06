<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimates', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl');
            $table->string('surveyor');
            $table->string('asuransi');
            $table->string('nopol');
            $table->string('type');
            $table->string('tahun');
            $table->string('warna');
            $table->string('norangka');
            $table->string('nomesin');
            $table->string('nama_tertanggung');
            $table->string('alamat');
            $table->string('telp');
            $table->char('status');
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
        Schema::dropIfExists('estimates');
    }
}
