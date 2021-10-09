<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransPro0 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure0 = "DROP PROCEDURE IF EXISTS `pr_postid0`;
        CREATE PROCEDURE `pr_postid0`(IN `bid` BIGINT UNSIGNED, IN `pid` BIGINT UNSIGNED)
        BEGIN
         insert into transactions (sourceseq,accountid,amntdb,amntcr,created_at,updated_at,currcode,docno,docdate,description_en,description_ar,dydate,sourceid,sourcetype,user_id,parent_id) SELECT `seq`,`Accno`,`DbAmount`,`CRAmount`,`createTime`,`updatetime`,`curr_code`,`main_DocNo`,`main_docdate`,`main_description`,`main_description_ar`,`main_date`,`myid`,`main_type`,`main_user_id`,`main_parent_id` FROM `trans_source` WHERE `myid`= bid and `main_parent_id` = pid
        END;";
        DB::unprepared($procedure0);
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
