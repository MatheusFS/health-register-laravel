<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToModelosPtTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('modelos_pt', function(Blueprint $table)
		{
			$table->foreign('id_usuario', 'modelos_pt_user_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('modelos_pt', function(Blueprint $table)
		{
			$table->dropForeign('modelos_pt_user_fk');
		});
	}

}
