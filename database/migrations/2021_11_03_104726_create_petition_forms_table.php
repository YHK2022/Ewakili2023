<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetitionFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('petition_forms', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('user_id')->unsigned()->nullable();
			$table->boolean('personal_detail')->default(0);
			$table->boolean('qualification')->default(0);
			$table->boolean('attachment')->default(0);
			$table->boolean('llb')->default(0);
			$table->integer('experience')->default(0);
			$table->integer('firm')->nullable()->default(0);
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
		Schema::drop('petition_forms');
	}

}
