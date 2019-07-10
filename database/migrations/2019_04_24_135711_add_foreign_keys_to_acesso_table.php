<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAcessoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('acesso', function(Blueprint $table)
		{
			$table->foreign('pagina', 'fk_acesso_pagina')->references('id_pagina')->on('paginas_sistema')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('perfil', 'fk_acesso_perfil')->references('id_perfil')->on('perfis')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('acesso', function(Blueprint $table)
		{
			$table->dropForeign('fk_acesso_pagina');
			$table->dropForeign('fk_acesso_perfil');
		});
	}

}
