<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIkmRespondenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ikm_responden', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('layanan_id')->unsigned();
            $table->enum('jenis_kelamin', ['1', '2']);
            $table->integer('umur_id')->unsigned();
            $table->integer('pendidikan_id')->unsigned();
            $table->integer('pekerjaan_id')->unsigned();
            $table->foreign('layanan_id')->references('id')->on('ikm_layanan')->onDelete('cascade');
            $table->foreign('umur_id')->references('id')->on('ikm_umur')->onDelete('cascade');
            $table->foreign('pendidikan_id')->references('id')->on('ikm_pendidikan')->onDelete('cascade');
            $table->foreign('pekerjaan_id')->references('id')->on('ikm_pekerjaan')->onDelete('cascade');
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
        Schema::dropIfExists('ikm_responden');
    }
}