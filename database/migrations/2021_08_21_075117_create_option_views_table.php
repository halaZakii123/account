<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
          CREATE VIEW view_typeOperation_main AS
          (
            SELECT * FROM options WHERE type = 'type_of_operation'
            )
        ");



        DB::statement("
          CREATE VIEW view_currencySymbol_main AS
          (
            SELECT * FROM options WHERE type = 'currency_symbol'
            )
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_view');
    }
}
