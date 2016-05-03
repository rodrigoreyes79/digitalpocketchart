<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNecessityVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('necessity_votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voting_id')->unsigned();
            $table->integer('necessity_id')->unsigned();
            $table->integer('group_1_count');
            $table->integer('group_2_count');
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
        Schema::drop('necessity_votes');
    }
}
