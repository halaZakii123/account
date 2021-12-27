<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeExplainedColumnTonull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subs', function (Blueprint $table) {

            $table->dropColumn('explained');
            $table->dropColumn('explained_ar');
        });

        Schema::table('subs', function (Blueprint $table) {

            $table->string('explained')->nullable();
            $table->string('explained_ar')->nullable();
        });
        Schema::table('mains', function (Blueprint $table) {

            $table->dropColumn('explained');
            $table->dropColumn('explained_ar');

            
        });
        Schema::table('mains', function (Blueprint $table) {

            $table->string('explained')->nullable();
            $table->string('explained_ar')->nullable();
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
