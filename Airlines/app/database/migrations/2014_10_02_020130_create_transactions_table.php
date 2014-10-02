<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table)
		{
			$table->integer('TsID')->primary();
			$table->string('TicketCode', 10);
			$table->time('BookingDate');
			$table->integer('Passenger', 11);
			$table->integer('Discount', 11);
			$table->integer('Flight', 11);
			$table->integer('SnID', 11);

			Schema::table('transactions', function($table) {
       		$table->foreign('passenger')->references('PsID')->on('passenger');
       		$table->foreign('flight')->references('FsID')->on('flight_schedule');
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
		Schema::drop('transactions');
	}

}
