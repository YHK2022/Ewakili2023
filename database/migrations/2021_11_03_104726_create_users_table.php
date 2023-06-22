<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
			$table->bigInteger('id', true)->unsigned();
			$table->string('username')->nullable();
			$table->string('email', 128)->unique();
			$table->string('mobile', 15)->nullable();
			$table->dateTime('email_verified_at')->nullable();
			$table->string('password');
			$table->string('status')->default('activated');
			$table->boolean('staff')->default(0);
			$table->boolean('verified')->default(0);
			$table->boolean('petitioner')->default(0);
			$table->string('remember_token', 100)->nullable();
			$table->timestamps(10);
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
