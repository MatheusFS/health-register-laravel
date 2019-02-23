<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParametrosDpTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parametros_dp', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_usuario')->index('id_idx');
			$table->string('nome', 20);
			$table->integer('quantificador');
			$table->string('lf', 40);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('parametros_dp');
	}

}
