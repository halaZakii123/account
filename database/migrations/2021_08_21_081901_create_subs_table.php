<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subs', function (Blueprint $table) {
            $table->id();
            $table->integer('debit');
            $table->integer('credit');
            $table->string('account_number');
            $table->String('explained');
            $table->string('explained_ar');

            $table->unsignedBigInteger('main_id');
            $table->timestamps();

            $table->foreign('main_id')
       ->references('id')
       ->on('mains')
       ->onUpdate('cascade')
       ->onDelete('cascade');
            });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subs');
    }
}
