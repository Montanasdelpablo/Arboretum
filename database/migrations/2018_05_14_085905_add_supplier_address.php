<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSupplierAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
        	$table->string('street')->nullable();
        	$table->integer('number')->nullable();
        	$table->string('addition', 5)->nullable();
        	$table->string('zip_code', 6)->nullable();
        	$table->string('city')->nullable();
        	$table->integer('phone_number')->nullable();
        	$table->string('website')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('suppliers', function (Blueprint $table) {
			$table->dropColumn(['street', 'number', 'additional', 'zip_code', 'city', 'phone_number', 'website']);
		});
    }
}
