<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegistrosCrismaPaginaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registros_crisma_pagina', function(Blueprint $table)
		{
			$table->integer('id_registros_crisma_pagina', true);
			$table->integer('pagina')->index('fk_registros_crisma_pagina__paginas_livros_registro');
			$table->integer('registro_crisma')->index('fk_registros_crisma_pagina__registros_crisma');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registros_crisma_pagina');
	}

}
