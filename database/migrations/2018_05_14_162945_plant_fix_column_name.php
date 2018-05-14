<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlantFixColumnName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('plants', function (Blueprint $table) {
			$table->dropForeign('plants_varietie_id_foreign');
			$table->dropColumn('varietie_id');

			$table->unsignedInteger('variety_id')->after('specie_id');
			$table->foreign('variety_id')->references('id')->on('varieties');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('plants', function (Blueprint $table) {
			$table->dropForeign('plants_variety_id_foreign');
			$table->dropColumn('variety_id');

			$table->unsignedInteger('varietie_id')->after('specie_id');
			$table->foreign('varietie_id')->references('id')->on('varieties');
		});
    }
}
