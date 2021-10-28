<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransMasterView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE  OR REPLACE VIEW `trans_master`  AS (
              SELECT `transactions`.`id` AS `trans_id`, `transactions`.`sourceid` AS `trans_sid`,
              `transactions`.`sourceseq` AS `trans_sseq`, `transactions`.`dydate` AS `trans_date`,
              `transactions`.`sourcetype` AS `trans_type`, `transactions`.`docno` AS `trans_docno`,
              `transactions`.`docdate` AS `trans_docdate`, `transactions`.`amntdb` AS `trans_db`,
              `transactions`.`amntcr` AS `trans_cr`, `transactions`.`amntdbc` AS `trans_dbc`,
              `transactions`.`amntcrc` AS `trans_crc`, `transactions`.`currcode` AS `trans_curr`,
              `transactions`.`accountid` AS `trans_accno`, `transactions`.`dealerid` AS `trans_dealerno`,
              `transactions`.`costid` AS `trans_costno`, `transactions`.`branchid` AS `trans_branchno`,
              `transactions`.`description_ar` AS `trans_descrip_ar`, `transactions`.`description_en` AS `trans_descrip_en`,
              `transactions`.`note_ar` AS `trans_note_ar`, `transactions`.`note_en` AS `trans_note_en`, `transactions`.`duedate` AS `trans_duedate`,
              `transactions`.`security` AS `trans_security`, `transactions`.`checked` AS `trans_checked`, `transactions`.`user_id` AS `trans_user_id`,
              `transactions`.`parent_id` AS `trans_cmpy`, `transactions`.`created_at` AS `trans_created_at`,
              `transactions`.`updated_at` AS `trans_updated_at`, `nv_accounts`.`acc_name` AS `acc_name`,
              `nv_accounts`.`acc_finalReport` AS `acc_finalReport`, `nv_accounts`.`acc_Cmpy_id` AS `acc_Cmpy_id`
              FROM (`transactions` left join `nv_accounts` on(`transactions`.`accountid` = `nv_accounts`.`acc_no` and `transactions`.`parent_id` = `nv_accounts`.`acc_Cmpy_id`))
              )");
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
