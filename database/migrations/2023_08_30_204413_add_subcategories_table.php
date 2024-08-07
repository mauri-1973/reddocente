<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubcategoriesTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id_sub')->unsigned();
            $table->string('name', 250);
            $table->unsignedBigInteger('cat_id')->unsigned();
            $table->string('carpeta', 250);
            $table->foreign('cat_id')->references('id_cat')->on('categories')->onDelete('cascade');
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
        Schema::drop('categories');
    }
}
