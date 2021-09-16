<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->string('avatar')->nullable()->after('user_id');
        });

        \Modules\Setting\Entities\Config::create([
            'key' => 'client_login',
            'value' => 0,
        ]);

        \Modules\RolePermission\Entities\Permission::forceCreate(['id'  => 607, 'module_id' => 14, 'parent_id' => 401, 'name' => 'Setting', 'route' => 'client.settings', 'type' => 2 ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
