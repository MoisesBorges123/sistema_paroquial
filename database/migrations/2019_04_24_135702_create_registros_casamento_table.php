<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegistrosCasamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registros_casamento', function(Blueprint $table)
		{
			$table->integer('id_rCasamento', true);
			$table->string('noivo');
			$table->string('noiva');
			$table->date('data_casamento');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registros_casamento');
	}

}
