<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVeiculosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('veiculos', function(Blueprint $table)
		{
			$table->integer('id_veiculo', true);
			$table->string('placa', 15);
			$table->string('modelo');
			$table->string('ano', 4);
			$table->integer('proprietario')->index('fk_veiculo_proprietario');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('veiculos');
	}

}
