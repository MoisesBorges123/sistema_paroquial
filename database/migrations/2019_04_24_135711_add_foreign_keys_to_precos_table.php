<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPrecosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('precos', function(Blueprint $table)
		{
			$table->foreign('modalidade', 'fk_preco_modalidade')->references('id_modalidade')->on('modalidade')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('precos', function(Blueprint $table)
		{
			$table->dropForeign('fk_preco_modalidade');
		});
	}

}
