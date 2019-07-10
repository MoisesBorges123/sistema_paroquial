<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLivrosRegistrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('livros_registros', function(Blueprint $table)
		{
			$table->foreign('tipo', 'fk_tipo_livro__livros_registrados')->references('id_tipos_livros_reg')->on('tipos_livros_registros')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('livros_registros', function(Blueprint $table)
		{
			$table->dropForeign('fk_tipo_livro__livros_registrados');
		});
	}

}
