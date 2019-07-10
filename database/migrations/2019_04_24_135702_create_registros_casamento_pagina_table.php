<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegistrosCasamentoPaginaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registros_casamento_pagina', function(Blueprint $table)
		{
			$table->integer('id_registros_casamento_pagina', true);
			$table->integer('pagina')->index('fk_registros_casamento_pagina__paginas_livros_registro');
			$table->integer('registro_casamento')->index('fk_registros_casamento_pagina__registros_casamento');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registros_casamento_pagina');
	}

}
