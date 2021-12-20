<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSubsTableExplainedToNullble extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nullble', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subs', function (Blueprint $table) {

            $table->dropColumn('explained');
            $table->dropColumn('explained_ar');

            $table->string('explained')->nullable();
            $table->string('explained_ar')->nullable();
        });
    }
}
