<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorMacule extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('color_macule', function (Blueprint $table) {
			$table->increments('id');

			$table->unsignedInteger('plant_id');
			$table->foreign('plant_id')->references('id')->on('plants');

			$table->unsignedInteger('color_id');
			$table->foreign('color_id')->references('id')->on('colors');

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
		Schema::dropIfExists('color_macule');
	}
}
