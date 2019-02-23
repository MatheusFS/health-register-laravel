<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAssocTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('assoc', function(Blueprint $table)
		{
			$table->foreign('child', 'assoc_child_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('parent', 'assoc_parent_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('assoc', function(Blueprint $table)
		{
			$table->dropForeign('assoc_child_fk');
			$table->dropForeign('assoc_parent_fk');
		});
	}

}
