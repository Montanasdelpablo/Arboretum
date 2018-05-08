<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('follow_number');
            $table->integer('purchase_number');
            $table->date('control');
            $table->string('place');
            $table->string('latitude');
            $table->string('longitude');
            $table->boolean('replant');
            $table->date('moved');
            $table->boolean('dead');
            $table->date('planted');
            $table->string('bloom_date');
            $table->text('note');
            $table->text('description');
            $table->string('image');

            $table->unsignedInteger('type_id');
            $table->foreign('type_id')->references('id')->on('types');

			$table->unsignedInteger('sex_id');
			$table->foreign('sex_id')->references('id')->on('sexes');

			$table->unsignedInteger('specie_id');
			$table->foreign('specie_id')->references('id')->on('species');

			$table->unsignedInteger('varietie_id');
			$table->foreign('varietie_id')->references('id')->on('varieties');

			$table->unsignedInteger('group_id');
			$table->foreign('group_id')->references('id')->on('groups');

			$table->unsignedInteger('synonym_id');
			$table->foreign('synonym_id')->references('id')->on('synonyms');

			$table->unsignedInteger('crossing_id');
			$table->foreign('crossing_id')->references('id')->on('crossings');

			$table->unsignedInteger('winner_id');
			$table->foreign('winner_id')->references('id')->on('winners');

			$table->unsignedInteger('treetype_id');
			$table->foreign('treetype_id')->references('id')->on('treetypes');

			$table->unsignedInteger('priority_id');
			$table->foreign('priority_id')->references('id')->on('priorities');

			$table->unsignedInteger('supplier_id');
			$table->foreign('supplier_id')->references('id')->on('suppliers');

			$table->unsignedInteger('size_id');
			$table->foreign('size_id')->references('id')->on('sizes');

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
        Schema::dropIfExists('plants');
    }
}
