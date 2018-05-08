<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloomMonth extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bloom_month', function (Blueprint $table) {
			$table->increments('id');

			$table->unsignedInteger('plant_id');
			$table->foreign('plant_id')->references('id')->on('plants');

			$table->unsignedInteger('month_id');
			$table->foreign('month_id')->references('id')->on('months');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('bloom_month');
	}
}
