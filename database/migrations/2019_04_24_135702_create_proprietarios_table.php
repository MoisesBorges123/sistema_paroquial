<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProprietariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proprietarios', function(Blueprint $table)
		{
			$table->integer('id_proprietario', true);
			$table->string('nome');
			$table->string('email');
			$table->string('telefone', 100);
			$table->string('celular', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('proprietarios');
	}

}
