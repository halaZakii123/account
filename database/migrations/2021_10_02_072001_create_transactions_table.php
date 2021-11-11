<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sourceid');
            $table->unsignedBigInteger('sourceseq');
            $table->date('dydate');
            $table->integer('sourcetype');
            $table->string('docno')->nullable();
            $table->date('docdate')->nullable();
            $table->decimal('amntdb',18,2)->default(0.0);
            $table->decimal('amntcr',18,2)->default(0.0);
            $table->decimal('amntdbc',18,2)->default(0.0);
            $table->decimal('amntcrc',18,2)->default(0.0);
            $table->string('currcode');
            $table->string('accountid');
            $table->string('dealerid')->nullable();
            $table->string('costid')->nullable();
            $table->integer('branchid')->nullable();
            $table->string('description_ar')->nullable();
            $table->string('description_en')->nullable();
            $table->string('note_ar')->nullable();
            $table->string('note_en')->nullable();
            $table->date('duedate')->nullable();
            $table->integer('security')->default(0.0);
            $table->boolean('checked')->default(0.0);
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
        Schema::dropIfExists('transactions');
    }
}
