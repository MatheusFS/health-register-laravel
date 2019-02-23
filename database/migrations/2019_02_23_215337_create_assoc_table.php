<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssocTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assoc', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('parent')->index('id_idx');
			$table->integer('child')->index('child_fk_idx');
			$table->simple_array('nivel');
			$table->time('h0');
			$table->time('hf');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('assoc');
	}

}
