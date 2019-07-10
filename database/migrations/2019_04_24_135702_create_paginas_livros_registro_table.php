<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaginasLivrosRegistroTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paginas_livros_registro', function(Blueprint $table)
		{
			$table->integer('id_pagina', true);
			$table->integer('livro')->index('fk_paginas_livros_registro__livros_registros');
			$table->string('num_pagina', 5);
			$table->string('foto');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('paginas_livros_registro');
	}

}
