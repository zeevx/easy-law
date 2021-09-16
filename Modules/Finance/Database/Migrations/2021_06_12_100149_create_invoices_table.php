<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clientable_id')->nullable();
            $table->string('clientable_type')->nullable();

            $table->foreignId('case_id')->nullable();
            $table->foreign('case_id')->on('cases')->references('id')->onDelete('cascade');

            $table->string('invoice_no')->nullable();
            $table->string('invoice_type')->nullable();
            $table->date('invoice_date')->default(now());
            $table->date('due_date')->nullable();
            $table->double('sub_total', 16, 2)->default(0);

            $table->double('discount', 16, 2)->default(0);
            $table->string('discount_type')->default('fixed');
            $table->double('discount_amount', 16, 2)->default(0);

            $table->double('net_total', 16, 2)->default(0)->comment('sub_total - discount_amount');

            $table->double('tax', 16, 2)->default(0);
            $table->double('tax_amount', 16, 2)->default(0);
            $table->foreignId('tax_id')->nullable();
            $table->foreign('tax_id')->on('taxes')->references('id')->onDelete('set null');

            $table->double('grand_total', 16, 2)->default(0)->comment('net_total + tax_amount');
            $table->double('paid', 16, 2)->default(0);
            $table->double('due', 16, 2)->default(0)->comment('grand_total - paid');
            $table->string('payment_status')->default('due');
            $table->text('note')->nullable();

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
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign('invoices_case_id_foreign');
            $table->dropForeign('invoices_tax_id_foreign');
            $table->dropForeign('invoices_created_by_foreign');
            $table->dropForeign('invoices_updated_by_foreign');
        });
        Schema::dropIfExists('invoices');
    }
}
