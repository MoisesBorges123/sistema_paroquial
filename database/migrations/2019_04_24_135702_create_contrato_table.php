<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContratoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contrato', function(Blueprint $table)
		{
			$table->integer('id_contrato', true);
			$table->integer('veiculo')->index('fk_contrato_veiculo');
			$table->integer('descricao');
			$table->integer('situacao')->comment('0-Inativo / 1-Ativo');
			$table->integer('preco')->index('fk_contrato_preco');
			$table->float('desconto', 10, 0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contrato');
	}

}
