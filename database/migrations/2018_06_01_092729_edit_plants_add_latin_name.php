<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditPlantsAddLatinName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('plants', function (Blueprint $table) {
			$table->string('latin_name')->nullable()->after('id');
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
			$table->dropColumn('latin_name');
		});
    }
}
