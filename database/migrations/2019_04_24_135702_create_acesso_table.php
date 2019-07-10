<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcessoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('acesso', function(Blueprint $table)
		{
			$table->integer('id_acesso', true);
			$table->integer('perfil')->index('fk_acesso_perfil');
			$table->integer('pagina')->index('fk_acesso_pagina');
			$table->integer('situacao');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('acesso');
	}

}
