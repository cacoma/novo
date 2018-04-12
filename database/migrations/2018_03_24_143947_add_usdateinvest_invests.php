<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsdateinvestInvests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
      Schema::table('invests', function (Blueprint $table) {
      $table->dateTime('dateinvest');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      //remove campo "Data do Investimento" na tabela invests - Machado - 09/04/2018 15:00hs
      $table->dropColumn('dateinvest');
    }
}
