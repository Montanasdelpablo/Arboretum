<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClearTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `plants` MODIFY COLUMN `name_id` INT(10) UNSIGNED NULL AFTER `image`');

        DB::statement('ALTER TABLE `suppliers` MODIFY COLUMN `created_at` TIMESTAMP NULL AFTER `website`');
        DB::statement('ALTER TABLE `suppliers` MODIFY COLUMN `updated_at` TIMESTAMP NULL AFTER `created_at`');

        DB::statement('ALTER TABLE `users` MODIFY COLUMN `last_name` VARCHAR(191) NOT NULL AFTER `first_name`');
        DB::statement('ALTER TABLE `users` MODIFY COLUMN `api_token` TEXT NULL AFTER `remember_token`');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		DB::statement('ALTER TABLE `plants` MODIFY COLUMN `name_id` INT(10) UNSIGNED NULL AFTER `id`');

		DB::statement('ALTER TABLE `suppliers` MODIFY COLUMN `created_at` TIMESTAMP NULL AFTER `name`');
		DB::statement('ALTER TABLE `suppliers` MODIFY COLUMN `updated_at` TIMESTAMP NULL AFTER `created_at`');

		DB::statement('ALTER TABLE `users` MODIFY COLUMN `last_name` VARCHAR(191) NOT NULL AFTER `updated_at`');
		DB::statement('ALTER TABLE `users` MODIFY COLUMN `api_token` TEXT NULL AFTER `last_name`');
    }
}
