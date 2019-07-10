<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMensalidadeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mensalidade', function(Blueprint $table)
		{
			$table->integer('id_mensalidade', true);
			$table->integer('contrato')->index('fk_mensalidade_contrato');
			$table->date('data_vencimento');
			$table->integer('pago')->comment('0-Pedente / 1-Pago');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mensalidade');
	}

}
