<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegistrosCrismaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registros_crisma', function(Blueprint $table)
		{
			$table->integer('id_rCrisma', true);
			$table->string('crismando');
			$table->string('padrinho');
			$table->date('data_crisma');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registros_crisma');
	}

}
