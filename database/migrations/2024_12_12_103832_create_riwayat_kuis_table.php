<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatKuisTable extends Migration
{
    public function up()
    {
        Schema::create('riwayat_kuis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kuis');
            $table->unsignedBigInteger('id_user');
            $table->integer('nilai');
            $table->timestamp('attempt_date');
            $table->timestamps();

            $table->foreign('id_kuis')->references('id')->on('kuis')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('riwayat_kuis');
    }
}
