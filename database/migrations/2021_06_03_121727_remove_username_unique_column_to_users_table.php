<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUsernameUniqueColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        \Illuminate\Support\Facades\DB::unprepared('ALTER TABLE users CHANGE username username VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;');
        \Illuminate\Support\Facades\DB::unprepared('ALTER TABLE users DROP INDEX users_username_unique;');
        \Illuminate\Support\Facades\DB::unprepared('ALTER TABLE users DROP INDEX users_email_unique;');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
