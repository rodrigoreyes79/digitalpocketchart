<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNecessitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('necessities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('tag', 100);
            $table->longText('notes', 255);
            $table->integer('poll_id')->unsigned();
            $table->boolean('community_idea')->default(false);
            $table->softDeletes();
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
        Schema::drop('necessities');
    }
}
