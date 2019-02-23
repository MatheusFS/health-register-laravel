<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModelosAnamneseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('modelos_anamnese', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_usuario')->index('id_idx');
			$table->string('nome', 30);
			$table->text('HC', 16777215);
			$table->string('DM', 100);
			$table->text('CE', 16777215);
			$table->text('CD', 16777215);
			$table->text('CP', 16777215);
			$table->text('sharedWith', 16777215);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('modelos_anamnese');
	}

}
