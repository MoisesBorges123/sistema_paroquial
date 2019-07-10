<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPaginasLivrosRegistroTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('paginas_livros_registro', function(Blueprint $table)
		{
			$table->foreign('livro', 'fk_paginas_livros_registro__livros_registros')->references('id_livros_registros')->on('livros_registros')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('paginas_livros_registro', function(Blueprint $table)
		{
			$table->dropForeign('fk_paginas_livros_registro__livros_registros');
		});
	}

}
