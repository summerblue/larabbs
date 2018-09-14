<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTopicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('topics', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->index();
			$table->text('body', 65535);
			$table->integer('user_id')->unsigned()->index();
			$table->integer('category_id')->unsigned()->index();
			$table->integer('reply_count')->unsigned()->default(0);
			$table->integer('view_count')->unsigned()->default(0);
			$table->integer('last_reply_user_id')->unsigned()->default(0);
			$table->integer('order')->unsigned()->default(0);
			$table->text('excerpt', 65535);
			$table->string('slug')->nullable();
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
		Schema::drop('topics');
	}

}
