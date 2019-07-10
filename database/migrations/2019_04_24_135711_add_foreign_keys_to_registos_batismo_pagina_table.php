<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRegistosBatismoPaginaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('registos_batismo_pagina', function(Blueprint $table)
		{
			$table->foreign('registro_batismo', 'fk_registros_batismo_pagina__registro_batismo')->references('id_rBatismo')->on('registro_batismo')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pagina', 'fk_registros_batismo_pagina__registros_casamento_pagina')->references('id_pagina')->on('paginas_livros_registro')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('registos_batismo_pagina', function(Blueprint $table)
		{
			$table->dropForeign('fk_registros_batismo_pagina__registro_batismo');
			$table->dropForeign('fk_registros_batismo_pagina__registros_casamento_pagina');
		});
	}

}
