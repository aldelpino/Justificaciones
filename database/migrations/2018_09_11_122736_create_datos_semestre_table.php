<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatosSemestreTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('datos_semestre', function(Blueprint $table)
		{
			$table->integer('id_dato', true);
			$table->string('RUT_ALU', 13);
			$table->string('COD_SECCION', 64);
			$table->string('NOM_ASIG', 128);
			$table->string('NOMBRE_ALUM', 128);
			$table->string('APEP_ALUM', 128);
			$table->string('APEM_ALUM', 128);
			$table->string('CORREO_ALUM', 512);
			$table->string('contrasena_alum', 512)->nullable();
			$table->string('recovery_alum', 512)->nullable();
			$table->string('CELULAR', 13);
			$table->string('cod_carrera', 512)->nullable();
			$table->string('CARRERA', 64);
			$table->string('JORNADA', 16);
			$table->string('rut_doc', 512)->nullable();
			$table->string('NOMBRE_DOC', 128);
			$table->string('APEP_DOC', 128);
			$table->string('CORREO_DOC', 512);
			$table->string('NOMBRE_COR', 128);
			$table->string('APEP_COR', 128);
			$table->string('APEM_COR', 128);
			$table->string('CORREO_COR', 512);
			$table->string('contrasena_cor', 512)->nullable();
			$table->string('recovery_cor', 512)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('datos_semestre');
	}

}
