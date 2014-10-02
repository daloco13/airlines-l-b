<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAircraftsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aircrafts', function(Blueprint $table)
		{
			$table->integer('AcID')->primary();
			$table->string('AcName', 65);
			$table->integer('Capacity', 11);
			
			Schema::table('aircrafts', function($table) {
       		$table->foreign('AcID')->references('aircraft')->on('flight_schedule');
   			});
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aircrafts');
	}

}
