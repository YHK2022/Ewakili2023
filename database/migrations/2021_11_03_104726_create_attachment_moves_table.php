<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentMovesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attachment_moves', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('user_id')->unsigned();
			$table->string('profile_picture', 220)->nullable();
			$table->string('petition', 200)->nullable();
			$table->string('csee', 200)->nullable();
			$table->string('necta', 200)->nullable();
			$table->string('acsee', 220)->nullable();
			$table->string('nacte', 200)->nullable();
			$table->string('llb_cert', 200)->nullable();
			$table->string('llb_trans', 200)->nullable();
			$table->string('tcu', 200)->nullable();
			$table->string('lst_cert', 200)->nullable();
			$table->string('lst_results', 200)->nullable();
			$table->string('pupilage', 200)->nullable();
			$table->string('intenship', 200)->nullable();
			$table->string('emp_later', 200)->nullable();
			$table->string('birth_cert', 200)->nullable();
			$table->string('char_cert', 200)->nullable();
			$table->string('deedpoll', 200)->nullable();
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
		Schema::drop('attachment_moves');
	}

}
