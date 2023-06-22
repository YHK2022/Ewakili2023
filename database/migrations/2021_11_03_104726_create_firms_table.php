<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('firms', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('members');
			$table->string('name', 200);
			$table->string('tin', 50);
			$table->string('type', 50);
			$table->integer('created_by');
			$table->string('status', 200)->nullable();
			$table->string('taxpayer_name', 200);
			$table->string('model', 200)->nullable();
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
		Schema::drop('firms');
	}

}
