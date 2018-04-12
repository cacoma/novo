<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBrokerIdToInvests extends Migration
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
      $table->integer('broker_id')->unsigned();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      //remove campo "Broker ID" na tabela invests - Machado - 09/04/2018 15:06hs
      $table->dropColumn('broker_id');
    }
}
