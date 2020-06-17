<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masuk', function (Blueprint $table) {
            $table->increments('id');
            $table->string('konsumen');
            $table->string('jenis_kendaraan');
            $table->string('no_pol');
            $table->date('tgl')->nullable();
            $table->string('jk');
            $table->string('no_hp');
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
        Schema::drop('masuk');
    }
}
