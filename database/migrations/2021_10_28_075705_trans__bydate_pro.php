<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransBydatePro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `pr_trans_Bydate`;

            CREATE  PROCEDURE `pr_trans_Bydate`(IN `bid` INT UNSIGNED, IN `frmdate` DATE, IN `tilldate` DATE)
            BEGIN
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
            acc_Cmpy_id from trans_master where `acc_Cmpy_id` = bid and trans_date >= frmdate and trans_date <= tilldate ;
            End ;";

          DB::unprepared($procedure);

    }
}
