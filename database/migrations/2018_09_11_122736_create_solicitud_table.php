<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSolicitudTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('solicitud', function(Blueprint $table)
		{
			$table->string('NFOLIO', 25);
			$table->integer('ID_DATO');
			$table->boolean('TIPO_INASISTENCIA')->nullable();
			$table->timestamp('FEC_SOL')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('FEC_JUS');
			$table->string('MOTIVO', 100);
			$table->string('ESTADO', 50);
			$table->string('COMENTARIO', 500)->nullable();
			$table->string('MOTIVO_REC', 100)->nullable();
			$table->string('COMENTARIO_REC', 512)->nullable();
			$table->string('NOMBRE_ALUM', 128);
			$table->string('CORREO_ALUM', 512);
			$table->string('CORREO_COR', 512);
			$table->string('CORREO_DOC', 512);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('solicitud');
	}

}
