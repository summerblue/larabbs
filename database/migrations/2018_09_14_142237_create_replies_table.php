<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRepliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('replies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('topic_id')->unsigned()->default(0)->index();
			$table->integer('user_id')->unsigned()->default(0)->index();
			$table->text('content', 65535);
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('replies');
	}

}
