<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOverruleHorarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('overrule_horario', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('child')->index('overrule_horario_child_fk');
			$table->integer('parent')->index('id_idx');
			$table->string('desde', 20);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('overrule_horario');
	}

}
