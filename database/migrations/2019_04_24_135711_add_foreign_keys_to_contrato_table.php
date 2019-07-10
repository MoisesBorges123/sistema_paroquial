<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToContratoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contrato', function(Blueprint $table)
		{
			$table->foreign('preco', 'fk_contrato_preco')->references('id_preco')->on('precos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('veiculo', 'fk_contrato_veiculo')->references('id_veiculo')->on('veiculos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contrato', function(Blueprint $table)
		{
			$table->dropForeign('fk_contrato_preco');
			$table->dropForeign('fk_contrato_veiculo');
		});
	}

}
