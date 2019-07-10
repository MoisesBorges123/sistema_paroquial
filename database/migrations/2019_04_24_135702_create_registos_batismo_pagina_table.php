<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegistosBatismoPaginaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registos_batismo_pagina', function(Blueprint $table)
		{
			$table->integer('id_registos_batismo_pagina');
			$table->integer('pagina')->index('fk_registros_batismo_pagina__registros_casamento_pagina');
			$table->integer('registro_batismo')->index('fk_registros_batismo_pagina__registro_batismo');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registos_batismo_pagina');
	}

}
