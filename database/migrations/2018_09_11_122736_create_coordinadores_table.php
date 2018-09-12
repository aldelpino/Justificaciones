<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoordinadoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coordinadores', function(Blueprint $table) {
			$table->integer('id_cor');
			$table->string('correo_cor');
			$table->string('nombre_cor', 256);
			$table->string('apep_cor', 256);
			$table->string('apem_cor', 256)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('coordinadores');
	}

}
