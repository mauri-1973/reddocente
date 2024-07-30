<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id_book')->unsigned();
            $table->string('name');
            $table->string('autor')->nullable();
            $table->string('descripcion')->nullable();
            $table->unsignedBigInteger('resource_id')->unsigned();
            $table->foreign('resource_id')->references('id_rec')->on('resources')->onDelete('cascade');
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
        Schema::drop('books');
    }
}
