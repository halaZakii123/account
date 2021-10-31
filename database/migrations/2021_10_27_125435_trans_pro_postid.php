<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransProPostid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `pr_postid`;

        CREATE  PROCEDURE `pr_postid`(IN `bid` BIGINT UNSIGNED, IN `pid` BIGINT UNSIGNED)
        BEGIN
          declare st int;
          delete from transactions where sourceid = bid
          and parent_id = pid;
          set st = (select type_of_operation from mains where id = bid and parent_id = pid);
          if st = 0 THEN
            SET @p0=bid; SET @p1=pid; CALL `pr_postid0`(@p0, @p1);
          end IF;
          if st = 1 THEN
            SET @p0=bid; SET @p1=pid; CALL `pr_postid1A`(@p0, @p1);
            SET @p0=bid; SET @p1=pid; CALL `pr_postid1B`(@p0, @p1);
          end IF;
          if st = 2 THEN
            SET @p0=bid; SET @p1=pid; CALL `pr_postid2A`(@p0, @p1);
            SET @p0=bid; SET @p1=pid; CALL `pr_postid2B`(@p0, @p1);
          end IF;
          if st = 3 THEN
            SET @p0=bid; SET @p1=pid; CALL `pr_postid3A`(@p0, @p1);
            SET @p0=bid; SET @p1=pid; CALL `pr_postid3B`(@p0, @p1);
          end IF;
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
