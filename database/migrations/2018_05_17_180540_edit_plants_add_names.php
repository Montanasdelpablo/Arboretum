<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditPlantsAddNames extends Migration
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
			$table->renameColumn( 'name', 'name_id' );
		});

		Schema::table('plants', function (Blueprint $table) {
			$table->unsignedInteger( 'name_id' )->nullable()->change();
			$table->foreign( 'name_id' )->references( 'id' )->on( 'names' );
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
			$table->dropForeign( 'plants_name_id_foreign' );
			$table->string( 'name_id' )->nullable()->change();
			$table->renameColumn( 'name_id', 'name' );
		});

		Schema::table('plants', function (Blueprint $table)
		{
			$table->renameColumn( 'name_id', 'name' );
		});
    }
}
