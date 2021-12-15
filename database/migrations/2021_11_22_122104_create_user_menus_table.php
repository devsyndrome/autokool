<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_menus', function (Blueprint $table) {
            $table->id();
            $table->char('id_user');
            $table->boolean('user');
            $table->boolean('estimasi');
            $table->boolean('spk');
            $table->boolean('logistik');
            $table->boolean('penawaran');
            $table->boolean('penawaranhpp');
            $table->boolean('spkhpp');
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
        Schema::dropIfExists('user_menus');
    }
}
