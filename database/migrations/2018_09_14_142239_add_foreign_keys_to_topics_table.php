<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTopicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('topics', function(Blueprint $table)
		{
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('topics', function(Blueprint $table)
		{
			$table->dropForeign('topics_user_id_foreign');
		});
	}

}
