<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('salutation')->nullable();
			$table->string('second_salutation')->nullable();
			$table->string('fullname');
			$table->string('gender', 100);
			$table->date('dob');
			$table->string('nationality', 100);
			$table->string('id_type', 100);
			$table->string('id_number', 200);
			$table->string('picture', 100)->nullable();
			$table->bigInteger('user_id')->unsigned()->nullable()->index('profiles_user_id_foreign');
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
		Schema::drop('profiles');
	}

}
