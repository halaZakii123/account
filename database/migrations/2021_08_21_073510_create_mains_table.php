<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('operation_date');
            $table->string('explained');
            $table->string('explained_ar');
            $table->string('type_of_operation');
            $table->string('currency_symbol');
            $table->decimal('exchange_rate');
            $table->date('doc_date');
            $table->string('doc_no');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('parent_id');
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
        Schema::dropIfExists('mains');
    }
}
