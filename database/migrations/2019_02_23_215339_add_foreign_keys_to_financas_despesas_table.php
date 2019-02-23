<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFinancasDespesasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('financas_despesas', function(Blueprint $table)
		{
			$table->foreign('id_usuario', 'financas_despesas_user_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('financas_despesas', function(Blueprint $table)
		{
			$table->dropForeign('financas_despesas_user_fk');
		});
	}

}
