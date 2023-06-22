<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmRequestConfirmationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('firm_request_confirmations', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('firm_id')->nullable();
			$table->integer('created_by')->nullable();
			$table->integer('requester_id')->nullable();
			$table->string('ver_code', 110)->nullable();
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
		Schema::drop('firm_request_confirmations');
	}

}
