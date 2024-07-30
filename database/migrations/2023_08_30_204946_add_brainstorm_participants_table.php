<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BrainstormParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brainstorm_participants', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('idbrainstorm')->unsigned();
            $table->unsignedBigInteger('iduser')->unsigned();
            $table->integar('statususer');

            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');

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
        Schema::drop('brainstorm_participants');
    }
}
