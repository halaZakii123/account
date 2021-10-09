<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransSourceView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("

            CREATE VIEW `trans_source`  AS  (
             SELECT `mains`.`id` AS `myid`,`subs`.`id` AS `seq`,`subs`.`account_number` AS `Accno`,`subs`.`debit` AS `DbAmount`,`subs`.`credit` AS `CRAmount`,`subs`.`created_at` AS `createTime`,`subs`.`updated_at` AS `updatetime`,`mains`.`cash_id` AS `cashid`,`mains`.`created_at` AS `main_createTime`,`mains`.`currency_symbol` AS `curr_code`,`mains`.`document_number` AS `main_DocNo`,`mains`.`doc_date` AS `main_docdate`,`mains`.`doc_no` AS `main_Doc_no`,`mains`.`exchange_rate` AS `main_currRate`,`mains`.`explained` AS `main_description`,`mains`.`explained_ar` AS `main_description_ar`,`mains`.`operation_date` AS `main_date`,`mains`.`parent_id` AS `main_parent_id`,`mains`.`type_of_operation` AS `main_type`,`mains`.`updated_at` AS `main_updatetime`,`mains`.`user_id` AS `main_user_id` from (`subs` left join `mains` on(`subs`.`main_id` = `mains`.`id`)) )
        ");
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
