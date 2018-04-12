<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsMonthlyQuotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //inserir campos na tabela, para inserir
      Schema::table('monthly_quotes', function (Blueprint $table) {
      $table->renameColumn('collected_at', 'timestamp');
      $table->decimal('open',18,4)->change();
      $table->decimal('high',18,4);
      $table->decimal('low',18,4);
      $table->decimal('close',18,4);
      $table->decimal('volume',18,4)->change();
      });
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
