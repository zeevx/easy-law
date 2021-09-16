<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFinanceModuleToModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $modules = [];
        $modules[] = ['name' => 'CustomField', 'details' => "This is Custom Field module for Infix Advocate. Thanks for using.", 'created_at' => now(), 'updated_at' => now(), 'order' => 1];
        $modules[] = ['name' => 'Finance', 'details' => "This is Finance module for Infix Advocate. Thanks for using.", 'created_at' => now(), 'updated_at' => now(), 'order' => 1];

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
        Schema::table('modules', function (Blueprint $table) {

        });
    }
}
