<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCadastroEmailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cadastro_emails', function(Blueprint $table)
		{
			$table->foreign('id_usuario', 'cadastro_emails_user_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cadastro_emails', function(Blueprint $table)
		{
			$table->dropForeign('cadastro_emails_user_fk');
		});
	}

}
