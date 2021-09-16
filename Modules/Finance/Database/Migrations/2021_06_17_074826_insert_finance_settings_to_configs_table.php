<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertFinanceSettingsToConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $settings = [
            [
                'key' => 'income_invoice_prefix',
                'value' => 'IA-Income',
            ],[
                'key' => 'expense_invoice_prefix',
                'value' => 'IA-Expense',
            ],[
                'key' => 'invoice_format',
                'value' => 1,
            ],[
                'key' => 'remarks_title',
                'value' => null,
            ],[
                'key' => 'remarks_body',
                'value' => null,
            ],[
                'key' => 'terms_conditions',
                'value' => null,
            ],[
                'key' => 'invoice_number_separator',
                'value' => '-',
            ],[
                'key' => 'invoice_number_padding',
                'value' => 4,
            ],

        ];
        \Modules\Setting\Entities\Config::insert($settings);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Modules\Setting\Entities\Config::whereIn('key', [
           'income_invoice_prefix',
            'expense_invoice_prefix',
            'invoice_format',
            'remarks_title',
            'remarks_body',
            'terms_conditions',
        ])->delete();
    }
}
