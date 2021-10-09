<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransactionsPro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `pr_postid`;
        CREATE PROCEDURE `pr_postid`(IN `bid` BIGINT UNSIGNED, IN `pid` BIGINT UNSIGNED)
        BEGIN
         delete from transactions where sourceid = bid and parent_id = pid ;
        END; ";


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
