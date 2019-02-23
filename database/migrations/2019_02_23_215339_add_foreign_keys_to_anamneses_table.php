<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAnamnesesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('anamneses', function(Blueprint $table)
		{
			$table->foreign('paciente', 'anamnese_paciente_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('responsavel', 'anamnese_responsavel_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('anamneses', function(Blueprint $table)
		{
			$table->dropForeign('anamnese_paciente_fk');
			$table->dropForeign('anamnese_responsavel_fk');
		});
	}

}
