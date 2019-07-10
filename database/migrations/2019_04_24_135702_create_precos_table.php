<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrecosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('precos', function(Blueprint $table)
		{
			$table->integer('id_preco', true);
			$table->float('valor', 10, 0);
			$table->dateTime('data');
			$table->integer('modalidade')->index('fk_preco_modalidade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('precos');
	}

}
