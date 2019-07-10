<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegistroBatismoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registro_batismo', function(Blueprint $table)
		{
			$table->integer('id_rBatismo', true);
			$table->string('batizando');
			$table->string('pai');
			$table->string('mae');
			$table->string('padrinho');
			$table->string('madrinha');
			$table->date('data_batismo');
			$table->date('data_nascimento');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registro_batismo');
	}

}
