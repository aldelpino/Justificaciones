<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlumnoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alumno', function(Blueprint $table)
		{
			$table->integer('id_alum');
			$table->string('nombre_alum');
			$table->string('apep_alum');
			$table->string('apem_alum')->nullable();
			$table->string('correo_alum')->default('');
			$table->string('celular')->nullable();
			$table->string('rut_alu');
			$table->string('correo_cor', 256);
			$table->string('carrera', 128);
			$table->string('jornada', 25);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('alumno');
	}

}
