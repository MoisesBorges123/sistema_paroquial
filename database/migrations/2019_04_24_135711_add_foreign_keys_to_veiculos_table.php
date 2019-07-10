<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVeiculosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('veiculos', function(Blueprint $table)
		{
			$table->foreign('proprietario', 'fk_veiculo_proprietario')->references('id_proprietario')->on('proprietarios')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('veiculos', function(Blueprint $table)
		{
			$table->dropForeign('fk_veiculo_proprietario');
		});
	}

}
