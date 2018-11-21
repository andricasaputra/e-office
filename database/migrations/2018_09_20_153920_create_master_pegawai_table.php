<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_pegawai', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('nip')->nullable();
            $table->string('jenis_karantina')->nullable();
            $table->integer('golongan_id')->unsigned()->nullable();
            $table->integer('jabatan_id')->unsigned()->nullable();
            $table->integer('wilker_id')->unsigned()->nullable();
            $table->integer('wilker_id_2')->unsigned()->nullable();
            $table->boolean('is_active')->default(1);
            $table->foreign('golongan_id')->references('id')->on('golongan');
            $table->foreign('jabatan_id')->references('id')->on('jabatan');
            $table->foreign('wilker_id')->references('id')->on('wilker');
            $table->foreign('wilker_id_2')->references('id')->on('wilker');
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
        Schema::dropIfExists('master_pegawai');
    }
}
