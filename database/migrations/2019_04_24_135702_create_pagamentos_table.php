<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagamentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pagamentos', function(Blueprint $table)
		{
			$table->integer('id_pagamento', true);
			$table->float('valor', 10, 0);
			$table->integer('mensalidade');
			$table->integer('horistas');
			$table->integer('situacao');
			$table->dateTime('data');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pagamentos');
	}

}
