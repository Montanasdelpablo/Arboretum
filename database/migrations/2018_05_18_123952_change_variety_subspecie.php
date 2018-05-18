<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeVarietySubspecie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('plants', function (Blueprint $table)
		{
			$table->dropForeign( 'plants_variety_id_foreign' );
			$table->renameColumn( 'variety_id', 'subspecie_id' );
		});

        Schema::rename('varieties', 'subspecies');

		Schema::table('plants', function (Blueprint $table)
		{
			$table->foreign('subspecie_id')->references('id')->on('subspecies');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('plants', function (Blueprint $table)
		{
			$table->dropForeign( 'plants_subspecie_id_foreign' );
			$table->renameColumn( 'subspecie_id', 'variety_id' );
		});

		Schema::rename('subspecies', 'varieties');

		Schema::table('plants', function (Blueprint $table)
		{
			$table->foreign('variety_id')->references('id')->on('varieties');
		});
    }
}
