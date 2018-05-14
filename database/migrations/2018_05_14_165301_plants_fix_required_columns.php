<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlantsFixRequiredColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('plants', function (Blueprint $table) {
			$table->string('name')->nullable()->change();
			$table->integer('follow_number')->nullable()->change();
			$table->integer('purchase_number')->nullable()->change();
			$table->date('control')->nullable()->change();
			$table->string('place')->nullable()->change();
			$table->string('latitude')->nullable()->change();
			$table->string('longitude')->nullable()->change();
			$table->boolean('replant')->nullable()->change();
			$table->date('moved')->nullable()->change();
			$table->boolean('dead')->nullable()->change();
			$table->date('planted')->nullable()->change();
			$table->text('note')->nullable()->change();
			$table->text('description')->nullable()->change();
			$table->string('image')->nullable()->change();
			$table->unsignedInteger('type_id')->nullable()->change();
			$table->unsignedInteger('sex_id')->nullable()->change();
			$table->unsignedInteger('specie_id')->nullable()->change();
			$table->unsignedInteger('variety_id')->nullable()->change();
			$table->unsignedInteger('group_id')->nullable()->change();
			$table->unsignedInteger('synonym_id')->nullable()->change();
			$table->unsignedInteger('crossing_id')->nullable()->change();
			$table->unsignedInteger('winner_id')->nullable()->change();
			$table->unsignedInteger('treetype_id')->nullable()->change();
			$table->unsignedInteger('priority_id')->nullable()->change();
			$table->unsignedInteger('supplier_id')->nullable()->change();
			$table->unsignedInteger('size_id')->nullable()->change();
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
			$table->string('name')->nullable(false)->change();
			$table->integer('follow_number')->nullable(false)->change();
			$table->integer('purchase_number')->nullable(false)->change();
			$table->date('control')->nullable(false)->change();
			$table->string('place')->nullable(false)->change();
			$table->string('latitude')->nullable(false)->change();
			$table->string('longitude')->nullable(false)->change();
			$table->boolean('replant')->nullable(false)->change();
			$table->date('moved')->nullable(false)->change();
			$table->boolean('dead')->nullable(false)->change();
			$table->date('planted')->nullable(false)->change();
			$table->text('note')->nullable(false)->change();
			$table->text('description')->nullable(false)->change();
			$table->string('image')->nullable(false)->change();
			$table->unsignedInteger('type_id')->nullable(false)->change();
			$table->unsignedInteger('sex_id')->nullable(false)->change();
			$table->unsignedInteger('specie_id')->nullable(false)->change();
			$table->unsignedInteger('variety_id')->nullable(false)->change();
			$table->unsignedInteger('group_id')->nullable(false)->change();
			$table->unsignedInteger('synonym_id')->nullable(false)->change();
			$table->unsignedInteger('crossing_id')->nullable(false)->change();
			$table->unsignedInteger('winner_id')->nullable(false)->change();
			$table->unsignedInteger('treetype_id')->nullable(false)->change();
			$table->unsignedInteger('priority_id')->nullable(false)->change();
			$table->unsignedInteger('supplier_id')->nullable(false)->change();
			$table->unsignedInteger('size_id')->nullable(false)->change();
		});
    }
}
