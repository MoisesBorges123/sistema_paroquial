<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRegistrosCasamentoPaginaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('registros_casamento_pagina', function(Blueprint $table)
		{
			$table->foreign('pagina', 'fk_registros_casamento_pagina__paginas_livros_registro')->references('id_pagina')->on('paginas_livros_registro')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('registro_casamento', 'fk_registros_casamento_pagina__registros_casamento')->references('id_rCasamento')->on('registros_casamento')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('registros_casamento_pagina', function(Blueprint $table)
		{
			$table->dropForeign('fk_registros_casamento_pagina__paginas_livros_registro');
			$table->dropForeign('fk_registros_casamento_pagina__registros_casamento');
		});
	}

}
