<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransByidPro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `pr_trans_Byid`;
            CREATE  PROCEDURE `pr_trans_Byid`(IN `bid` INT UNSIGNED, IN `sid` INT UNSIGNED)
            BEGIN
             select * from trans_master where trans_sid = sid and acc_cmpy_id = bid ;
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
