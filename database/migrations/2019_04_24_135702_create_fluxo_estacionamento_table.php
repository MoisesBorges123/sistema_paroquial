<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFluxoEstacionamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fluxo_estacionamento', function(Blueprint $table)
		{
			$table->integer('id_fluxo', true);
			$table->string('placa', 15);
			$table->integer('vaga');
			$table->dateTime('entrada');
			$table->dateTime('saida');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fluxo_estacionamento');
	}

}
