<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRepliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('replies', function(Blueprint $table)
		{
			$table->foreign('topic_id')->references('id')->on('topics')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
		Schema::table('replies', function(Blueprint $table)
		{
			$table->dropForeign('replies_topic_id_foreign');
			$table->dropForeign('replies_user_id_foreign');
		});
	}

}
