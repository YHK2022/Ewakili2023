<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('firm_addresses', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('firm_id')->unsigned();
			$table->string('address', 100);
			$table->string('region', 100);
			$table->string('district', 100);
			$table->string('ward', 100);
			$table->string('street', 100);
			$table->bigInteger('postcode');
			$table->string('position', 100);
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
		Schema::drop('firm_addresses');
	}

}
