<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\users;


class AddUseridToInvests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //cria campo user ID na tabela invests
      Schema::table('invests', function (Blueprint $table) {
      $table->foreign('user_id')->references('id')->on('users');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //remove campo user ID na tabela invests - Machado - 09/04/2018 14:25hs
        $table->dropColumn('user_id');
    }
}
