<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCadastrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cadastros', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->string('pais', 35);
			$table->string('funcao', 20);
			$table->string('nome', 65);
			$table->string('nome_f', 30)->nullable();
			$table->string('cpf_cnpj', 20);
			$table->enum('sexo', array('m','f','o'))->nullable();
			$table->date('birthdate')->nullable();
			$table->string('profissao', 70)->nullable();
			$table->string('profissao_nrp', 20)->nullable();
			$table->string('profissao_entidade', 20)->nullable();
			$table->string('responsavel', 50)->nullable();
			$table->boolean('trancado');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cadastros');
	}

}
