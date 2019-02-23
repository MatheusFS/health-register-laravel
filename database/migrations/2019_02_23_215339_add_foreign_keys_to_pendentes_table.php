<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPendentesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pendentes', function(Blueprint $table)
		{
			$table->foreign('de', 'pendentes_de_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('para', 'pendentes_para_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pendentes', function(Blueprint $table)
		{
			$table->dropForeign('pendentes_de_fk');
			$table->dropForeign('pendentes_para_fk');
		});
	}

}
