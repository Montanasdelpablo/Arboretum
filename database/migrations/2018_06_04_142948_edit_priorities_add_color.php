<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditPrioritiesAddColor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('priorities', function (Blueprint $table) {
			$table->string('color', 7)->after( 'name' );
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('priorities', function (Blueprint $table) {
			$table->dropColumn('color');
		});
    }
}
