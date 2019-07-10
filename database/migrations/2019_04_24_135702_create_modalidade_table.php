<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModalidadeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('modalidade', function(Blueprint $table)
		{
			$table->integer('id_modalidade', true);
			$table->string('modalidade');
			$table->string('descricao');
			$table->integer('tempo');
			$table->char('veiculo', 1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('modalidade');
	}

}
