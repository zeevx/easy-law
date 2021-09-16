<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomFieldResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_field_responses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('custom_field_id')->nullable();
            $table->foreign('custom_field_id')->on('custom_fields')->references('id')->onDelete('cascade');

            $table->unsignedBigInteger('morphable_id')->nullable();
            $table->string('morphable_type')->nullable();

            $table->text('text')->nullable();
            $table->integer('integer')->nullable();
            $table->string('string')->nullable();
            $table->timestamp('date')->nullable();

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
        Schema::dropIfExists('field_responses');
    }
}
