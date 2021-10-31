<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BldailyPro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `pr_BLdaily`;
            CREATE  PROCEDURE `pr_BLdaily`(IN `bid` INT)
            BEGIN
            select
            sum(`trans_db`) As Db ,Sum(`trans_cr`) as CR ,sum(`trans_db`) -Sum(`trans_cr`) aS BAl,

            sum(`trans_dbc`) as Dbc,sum(`trans_crc`) as Crc ,sum(`trans_dbc`) - sum(`trans_crc`) as BAlc
            ,`trans_curr`,
            nv_accounts.acc_no, nv_accounts.acc_name,nv_accounts.acc_finalReport from trans_master left join nv_accounts
            on `trans_accno` =nv_accounts.acc_no and trans_cmpy = nv_accounts.acc_Cmpy_id
            where trans_cmpy  =bid
            group by `trans_accno`,`trans_curr`,nv_accounts.acc_id		,	nv_accounts.acc_no,	nv_accounts.acc_name,			 	nv_accounts.acc_finalReport,		nv_accounts.acc_Cmpy_id ;
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
