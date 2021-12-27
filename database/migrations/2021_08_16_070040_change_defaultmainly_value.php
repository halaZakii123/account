<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDefaultmainlyValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_accounts', function (Blueprint $table) {
            $table->dropColumn('mainly');
        });

        Schema::table('tbl_accounts', function (Blueprint $table) {
            $table->boolean('mainly')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_accounts', function (Blueprint $table) {
        });
    }
}
