<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransByaccPro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `pr_trans_Byacc`;
            CREATE  PROCEDURE `pr_trans_Byacc`(IN `bid` INT UNSIGNED, IN `accid` VARCHAR(50)
                     CHARSET utf8, IN `frmdate` DATE, IN `tilldate` DATE)
            BEGIN
            select
                0 as trans_id,
                0 as trans_sid,
                0 as trans_sseq,
                frmdate as trans_date,
                0 as  trans_type,
                0 as trans_docno,
                frmdate as trans_docdate,
                sum(trans_db) as trans_db,
                sum(trans_cr) as trans_cr,
                sum(trans_dbc) as trans_dbc,
                SUM(trans_crc) as trans_crc,
                0 as trans_curr,
                accid as trans_accno,
                0 as trans_dealerno,
                0 as trans_costno,
                0 as trans_branchno,
                'before' as trans_descrip_ar,
                'before' as trans_descrip_en,
                '' as trans_note_ar,
                '' as trans_note_en,
                null as trans_duedate,
                null as trans_security,
                null as trans_checked,
                null as trans_user_id,
                bid as trans_cmpy,
                null as trans_created_at,
                null as trans_updated_at,
                null as acc_name,
                null as acc_finalReport,
                bid as acc_Cmpy_id from trans_master where trans_accno = accid and `acc_Cmpy_id` = bid and trans_date < frmdate
                group by trans_accno
              union
              select
                trans_id,
                trans_sid,
                trans_sseq,
                trans_date,
                trans_type,
                trans_docno,
                trans_docdate,
                trans_db,
                trans_cr,
                trans_dbc,
                trans_crc,
                trans_curr,
                trans_accno,
                trans_dealerno,
                trans_costno,
                trans_branchno,
                trans_descrip_ar,
                trans_descrip_en,
                trans_note_ar,
                trans_note_en,
                trans_duedate,
                trans_security,
                trans_checked,
                trans_user_id,
                trans_cmpy,
                trans_created_at,
                trans_updated_at,
                acc_name,
                acc_finalReport,
                acc_Cmpy_id
              from trans_master where trans_accno = accid and `acc_Cmpy_id` = bid and trans_date >= frmdate and trans_date <= tilldate 
              ORDER BY trans_date ASC ;
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
