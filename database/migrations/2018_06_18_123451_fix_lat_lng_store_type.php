<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixLatLngStoreType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('plants', function (Blueprint $table) {
	   		$table->decimal('latitude', 11, 8)->nullable()->change();
	   		$table->decimal('longitude', 12, 8)->nullable()->change();
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
	   		$table->string('latitude')->nullable()->change();
	   		$table->string('longitude')->nullable()->change();
		});
    }
}
