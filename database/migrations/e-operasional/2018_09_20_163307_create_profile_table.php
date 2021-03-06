<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_pegawai_id')->unsigned();
            $table->string('nama', 100)->nullable();
            $table->string('ttl', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('hp', 25)->nullable();
            $table->string('icon')->nullable();
            $table->foreign('master_pegawai_id')->references('id')->on('master_pegawai');
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
        Schema::dropIfExists('profile');
    }
}
