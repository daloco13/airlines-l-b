<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirfareTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('airfare', function(Blueprint $table)
		{
			$table->integer('AfID')->primary();
			$table->integer('Route');
			$table->Fare('Fare');
			
			Schema::table('airfare', function($table) {
       		$table->foreign('AfID')->references('airfare')->on('flight_schedule');
       		$table->foreign('Route')->references('RtID')->on('flight_schedule');
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
		Schema::drop('airfare');
	}

}
