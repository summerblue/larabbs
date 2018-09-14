<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('phone')->nullable()->unique();
			$table->string('email')->nullable()->unique();
			$table->string('password')->nullable();
			$table->string('weixin_openid')->nullable()->unique();
			$table->string('weapp_openid')->nullable()->unique();
			$table->string('weixin_session_key')->nullable();
			$table->string('weixin_unionid')->nullable()->unique();
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->string('avatar')->nullable();
			$table->string('introduction')->nullable();
			$table->integer('notification_count')->unsigned()->default(0);
			$table->dateTime('last_actived_at')->nullable();
			$table->string('registration_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
