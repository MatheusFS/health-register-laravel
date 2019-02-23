<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCadastroEndTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cadastro_end', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_usuario')->index('id_idx');
			$table->string('tipo', 30);
			$table->string('cep', 14);
			$table->string('logradouro', 55);
			$table->integer('numero');
			$table->string('complemento', 60)->nullable();
			$table->string('bairro', 30);
			$table->string('cidade', 30);
			$table->string('uf', 20);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cadastro_end');
	}

}
