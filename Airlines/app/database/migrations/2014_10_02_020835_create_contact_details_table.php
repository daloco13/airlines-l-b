<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contact_details', function(Blueprint $table)
		{
			$table->integer('CnID')->primary();
			$table->string('Email', 255);
			$table->string('Mobile', 255);
			$table->string('Street', 255);
			$table->string('ZipCode', 255);
			$table->string('City', 255);
			$table->string('Country', 255);

			Schema::table('contact_details', function($table) {
       		$table->foreign('CnID')->references('contact')->on('passenger');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contact_details');
	}

}
