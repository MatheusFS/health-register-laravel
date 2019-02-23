<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePendentesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pendentes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('de')->index('id_idx');
			$table->integer('para')->index('para_pk_idx');
			$table->enum('tipo', array('assoc','ovrl_hr','ovrl_set','chng_inf','actv_acc','avlzr_anam'));
			$table->text('scriptArray', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pendentes');
	}

}
