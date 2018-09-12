<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJustificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('justifications', function(Blueprint $table)
		{
			$table->integer('ID_DATO', true);
			$table->string('NFOLIO', 25)->nullable();
			$table->boolean('TIPO_INASISTENCIA')->nullable();
			$table->dateTime('FEC_SOL')->nullable();
			$table->string('FEC_JUS', 30)->nullable();
			$table->string('MOTIVO', 100)->nullable();
			$table->string('ESTADO', 50)->nullable();
			$table->string('COMENTARIO', 500)->nullable();
			$table->string('MOTIVO_REC', 100)->nullable();
			$table->string('COMENTARIO_REC', 512)->nullable();
			$table->string('NOMBRE_ALUM', 128)->nullable();
			$table->string('CORREO_ALUM', 512)->nullable();
			$table->string('CORREO_COR', 512)->nullable();
			$table->string('CORREO_DOC', 512)->nullable();
			$table->string('CELULAR_ALUM', 45)->nullable();
			$table->dateTime('UPDATED_AT')->nullable();
			$table->string('ASIGNATURA', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('justifications');
	}

}
