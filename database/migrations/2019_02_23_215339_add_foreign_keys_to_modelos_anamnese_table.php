<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToModelosAnamneseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('modelos_anamnese', function(Blueprint $table)
		{
			$table->foreign('id_usuario', 'modelos_anamnese_user_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('modelos_anamnese', function(Blueprint $table)
		{
			$table->dropForeign('modelos_anamnese_user_fk');
		});
	}

}
