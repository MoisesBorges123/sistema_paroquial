<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRegistrosCrismaPaginaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('registros_crisma_pagina', function(Blueprint $table)
		{
			$table->foreign('pagina', 'fk_registros_crisma_pagina__paginas_livros_registro')->references('id_pagina')->on('paginas_livros_registro')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('registro_crisma', 'fk_registros_crisma_pagina__registros_crisma')->references('id_rCrisma')->on('registros_crisma')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('registros_crisma_pagina', function(Blueprint $table)
		{
			$table->dropForeign('fk_registros_crisma_pagina__paginas_livros_registro');
			$table->dropForeign('fk_registros_crisma_pagina__registros_crisma');
		});
	}

}
