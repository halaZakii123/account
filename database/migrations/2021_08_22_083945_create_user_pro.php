<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUserPro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `pr_users`;
        CREATE PROCEDURE `pr_users` (IN id bigint)
        BEGIN
         SELECT * FROM users WHERE parent_id = id ;
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
        Schema::dropIfExists('user_pro');
    }
}
