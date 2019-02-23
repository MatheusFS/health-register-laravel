<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnamnesesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('anamneses', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('paciente')->index('id_idx');
			$table->integer('responsavel')->index('responsavel_fk_idx');
			$table->integer('hadHelp')->nullable();
			$table->integer('avalizado');
			$table->string('endereco', 100);
			$table->text('info_medico', 16777215);
			$table->text('doencas', 16777215);
			$table->text('HC', 16777215);
			$table->text('CE', 16777215);
			$table->string('CE_imgs', 300);
			$table->text('CD', 16777215);
			$table->text('CP', 16777215);
			$table->text('PT', 16777215);
			$table->float('preco', 10, 0);
			$table->string('data', 30);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('anamneses');
	}

}
