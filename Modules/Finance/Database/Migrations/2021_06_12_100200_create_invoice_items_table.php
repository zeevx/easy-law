<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('invoice_id')->nullable();
            $table->foreign('invoice_id')->on('invoices')->references('id')->onDelete('cascade');

            $table->foreignId('service_type_id')->nullable();
            $table->foreign('service_type_id')->on('services')->references('id')->onDelete('cascade');

            $table->double('qty', 16,2)->default(0);
            $table->double('amount', 16,2)->default(0);
            $table->double('total', 16,2)->default(0);

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
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->dropForeign('invoice_items_invoice_id_foreign');
            $table->dropForeign('invoice_items_service_type_id_foreign');
        });
        Schema::dropIfExists('invoice_items');
    }
}
