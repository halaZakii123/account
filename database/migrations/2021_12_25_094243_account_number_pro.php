<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AccountNumberPro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `PR_Account_number`;

        CREATE  PROCEDURE `PR_Account_number`(IN id bigint)
        BEGIN
         SELECT count(*) FROM tbl_accounts  WHERE parent_id = id ;
        END;" ;

        DB::unprepared($procedure);
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
