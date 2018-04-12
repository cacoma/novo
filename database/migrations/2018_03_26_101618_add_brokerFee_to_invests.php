<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBrokerFeeToInvests extends Migration
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
      $table->decimal('broker_fee',12,2);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      //remove campo "Broker Fee" na tabela invests - Machado - 09/04/2018 15:05hs
      $table->dropColumn('broker_fee');
    }
}
