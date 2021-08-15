<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_number');
            $table->string('account_name')->unique();
            $table->string('master_account_number')->nullable();
            $table->string('report');
            $table->boolean('mainly')->nullable()->default(false);;
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_accounts');
    }
}
