<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('route', function(Blueprint $table)
		{
			$table->integer('RtID')->primary();
			$table->integer('Origin', 11);
			$table->integer('Destination', 11);

			Schema::table('route', function($table) {
       		$table->foreign('RtID')->references('Route')->on('airfare');
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
		Schema::drop('route');
	}

}
