<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOverruleHorarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('overrule_horario', function(Blueprint $table)
		{
			$table->foreign('child', 'overrule_horario_child_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('parent', 'overrule_horario_parent_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('overrule_horario', function(Blueprint $table)
		{
			$table->dropForeign('overrule_horario_child_fk');
			$table->dropForeign('overrule_horario_parent_fk');
		});
	}

}
