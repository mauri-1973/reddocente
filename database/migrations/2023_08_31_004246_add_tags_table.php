<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id_tag')->unsigned();
            $table->text('coments');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('resource_tag', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('tag_id_resource')->unsigned();
            $table->unsignedBigInteger('resource_id')->unsigned();
            $table->unsignedBigInteger('tag_id')->unsigned();

            $table->foreign('resource_id')
                    ->references('id_rec')
                    ->on('resources')->onDelete('cascade');

            $table->foreign('tag_id')
                    ->references('id_tag')
                    ->on('tags')->onDelete('cascade');

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
        Schema::drop('resource_tag');
        Schema::drop('tags');
    }
}
