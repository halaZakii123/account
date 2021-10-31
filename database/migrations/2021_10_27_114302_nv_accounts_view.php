<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NvAccountsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
                CREATE  OR REPLACE VIEW `nv_accounts`  AS (
                SELECT `tbl_accounts`.`id` AS `acc_id`, `tbl_accounts`.`account_number` AS `acc_no`,
                `tbl_accounts`.`account_name` AS `acc_name`, `tbl_accounts`.`master_account_number` AS `acc_belongTo`,
                `tbl_accounts`.`report` AS `acc_finalReport`, `tbl_accounts`.`user_id` AS `acc_creator_id`,
                `tbl_accounts`.`parent_id` AS `acc_Cmpy_id`, `tbl_accounts`.`created_at` AS `acc_created_at`,
                `tbl_accounts`.`updated_at` AS `acc_updated_at`, `tbl_accounts`.`mainly` AS `acc_ismaster`,
                `mst_account`.`id` AS `mst_acc_id`, `mst_account`.`account_number` AS `mst_acc_no`,
                `mst_account`.`account_name` AS `mst_acc_name`,
                `mst_account`.`master_account_number` AS `mst_acc_belongTo`,
                `mst_account`.`report` AS `mst_acc_finalReport`, `mst_account`.`mainly` AS `mst_acc_ismaster`,
                `mst_account`.`parent_id` AS `mst_Cmpy_id`
                 FROM (`tbl_accounts` left join `tbl_accounts` `mst_account` on(`tbl_accounts`.`master_account_number` = `mst_account`.`account_number` and `tbl_accounts`.`parent_id` = `mst_account`.`parent_id`)) )

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
