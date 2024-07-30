<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsuarioDocentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuariodocentes', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id_usudoc')->unsigned();
            $table->unsignedBigInteger('id_us')->unsigned();
            $table->unsignedBigInteger('id_res')->unsigned();
            $table->foreign('id_us')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_res')->references('id_rec')->on('resources')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuariodocentes');
    }
}
