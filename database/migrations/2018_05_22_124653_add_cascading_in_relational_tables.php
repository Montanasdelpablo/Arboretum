<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCascadingInRelationalTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('bloom_color', function (Blueprint $table)
		{
			$table->dropForeign('bloom_color_color_id_foreign');
			$table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');

			$table->dropForeign('bloom_color_plant_id_foreign');
			$table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');
		});

		Schema::table('color_macule', function (Blueprint $table)
		{
			$table->dropForeign('color_macule_color_id_foreign');
			$table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');

			$table->dropForeign('color_macule_plant_id_foreign');
			$table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');
		});

		Schema::table('month_plant', function (Blueprint $table)
		{
			$table->dropForeign('bloom_month_month_id_foreign');
			$table->foreign('month_id')->references('id')->on('months')->onDelete('cascade');

			$table->dropForeign('bloom_month_plant_id_foreign');
			$table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('bloom_color', function (Blueprint $table)
		{
			$table->dropForeign('bloom_color_color_id_foreign');
			$table->foreign('color_id')->references('id')->on('colors')->onDelete('restrict');

			$table->dropForeign('bloom_color_plant_id_foreign');
			$table->foreign('plant_id')->references('id')->on('plants')->onDelete('restrict');
		});

		Schema::table('color_macule', function (Blueprint $table)
		{
			$table->dropForeign('color_macule_color_id_foreign');
			$table->foreign('color_id')->references('id')->on('colors')->onDelete('restrict');

			$table->dropForeign('color_macule_plant_id_foreign');
			$table->foreign('plant_id')->references('id')->on('plants')->onDelete('restrict');
		});

		Schema::table('month_plant', function (Blueprint $table)
		{
			$table->dropForeign('month_plant_month_id_foreign');
			$table->foreign('month_id')->references('id')->on('months')->onDelete('restrict');

			$table->dropForeign('month_plant_plant_id_foreign');
			$table->foreign('plant_id')->references('id')->on('plants')->onDelete('restrict');
		});
    }
}
