<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('status')->default(1);
            $table->text('details')->nullable();
            $table->integer('order');
            $table->timestamps();
        });

        $modules = ['name' => 'ClientLogin', 'details' => "This is Client Login module for Infix Advocate. Thanks for using.", 'created_at' => now(), 'updated_at' => now(), 'order' => 1];

        DB::table('modules')->insert([
            $modules
        ]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
