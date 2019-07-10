<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLivrosRegistrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('livros_registros', function(Blueprint $table)
		{
			$table->integer('id_livros_registros', true);
			$table->string('numero', 11);
			$table->string('observacao');
			$table->integer('tipo')->index('fk_tipo_livro__livros_registrados');
                        $table->dateTime('created_at');
                        $table->dateTime('updated_at');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('livros_registros');
	}

}
