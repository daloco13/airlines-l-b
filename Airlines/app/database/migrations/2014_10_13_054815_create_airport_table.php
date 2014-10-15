<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirportTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('airport', function(Blueprint $table)
		{
			$table->integer('ApID', true)->primary();
			$table->string('AirportCode', 255);
			$table->string('Location', 255);
			$table->string('Country', 255);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('airport');
	}

}
