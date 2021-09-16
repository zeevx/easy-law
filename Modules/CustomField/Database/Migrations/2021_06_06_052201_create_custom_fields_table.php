<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->id();

            $table->string('form_name')->nullable();
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->string('default_value')->nullable();
            $table->string('pattern')->nullable();
            $table->string('min')->nullable();
            $table->string('max')->nullable();
            $table->string('width')->default('col-12');
            $table->boolean('required')->default(false);
            $table->longText('values')->nullable();
            $table->foreignId('controlled_field')->nullable();
            $table->foreign('controlled_field')->references('id')->on('custom_fields')->onDelete('set null');
            $table->longText('controlled_field_value')->nullable();
            $table->mediumText('description')->nullable();

            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('custom_fields');
    }
}
