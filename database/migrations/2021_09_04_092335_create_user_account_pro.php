<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccountPro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `pr_userAccounts`;
        CREATE PROCEDURE `pr_userAccounts` (IN id bigint)
        BEGIN
         SELECT * FROM tbl_accounts WHERE user_id = id   ;
        End;" ;
        DB::unprepared($procedure);


        $procedure = "DROP PROCEDURE IF EXISTS `pr_userMains`;
        CREATE PROCEDURE `pr_userMains` (IN id bigint)
        BEGIN
         SELECT * FROM mains WHERE user_id = id ;
        End; ";
        DB::unprepared($procedure);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_account_pro');
    }
}
