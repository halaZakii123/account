<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BuildaccPro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `pr_buildacc`;
        CREATE  PROCEDURE `pr_buildacc`(IN `bid` INT)
        BEGIN
        insert into tbl_accounts (`account_number`,`account_name`,`master_account_number`,`report`,user_id,parent_id,`mainly`) SELECT `account_number`,`account_name`,`master_account_number`,`report`,bid,bid,`mainly` FROM `tbl_accounts` where parent_id = 0 ;
        END;";
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
