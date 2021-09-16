<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailToCLModuleToModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $modules = [];
        $modules[] = ['name' => 'EmailtoCL', 'details' => "This Module will allow you to send Email to Lawyers and courts. Thanks for using.", 'created_at' => now(), 'updated_at' => now(), 'order' => 1];

        DB::table('modules')->insert(
            $modules
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Modules\ModuleManager\Entities\Module::where('name', 'EmailtoCL')->delete();
    }
}
