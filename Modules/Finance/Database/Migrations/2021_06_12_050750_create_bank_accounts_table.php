<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();

            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();

            $table->bigInteger('opening_balance')->default(0);
            $table->text("description")->nullable();

            $table->boolean("status")->default(true);

            $table->foreignId('created_by')->nullable();
            $table->foreign('created_by')->on('users')->references('id')->onDelete('set null');

            $table->foreignId('updated_by')->nullable();
            $table->foreign('updated_by')->on('users')->references('id')->onDelete('set null');

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
        Schema::dropIfExists('bank_accounts');
    }
}
