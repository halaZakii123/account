<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OptionPollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_polls', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('votes')->default(0);
            $table->unsignedBigInteger('poll_id');
            $table->timestamps();
            $table->foreign('poll_id')->references('id')->on('polls');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
