<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FinanceModuelPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = [


            //Vendor
            ['id'  => 2401, 'module_id' => 24, 'parent_id' => null, 'name' => 'Vendor', 'route' => 'vendors.index', 'type' => 1 ],
            ['id'  => 2402, 'module_id' => 24, 'parent_id' => 2401, 'name' => 'Add', 'route' => 'vendors.store', 'type' => 2 ],
            ['id'  => 2403, 'module_id' => 24, 'parent_id' => 2401, 'name' => 'Edit', 'route' => 'vendors.edit', 'type' => 2 ],
            ['id'  => 2404, 'module_id' => 24, 'parent_id' => 2401, 'name' => 'Delete', 'route' => 'vendors.destroy', 'type' => 2 ],

               //Service
            ['id'  => 2501, 'module_id' => 25, 'parent_id' => null, 'name' => 'Services', 'route' => 'services.index', 'type' => 1 ],
            ['id'  => 2502, 'module_id' => 25, 'parent_id' => 2501, 'name' => 'Add', 'route' => 'services.store', 'type' => 2 ],
            ['id'  => 2503, 'module_id' => 25, 'parent_id' => 2501, 'name' => 'Edit', 'route' => 'services.edit', 'type' => 2 ],
            ['id'  => 2504, 'module_id' => 25, 'parent_id' => 2501, 'name' => 'Delete', 'route' => 'services.destroy', 'type' => 2 ],


            // Finance

            ['id'  => 2601, 'module_id' => 26, 'parent_id' => null, 'name' => 'Finance', 'route' => 'finance.index', 'type' => 1 ],

            //Income Type
            ['id'  => 2602, 'module_id' => 25, 'parent_id' => 2601, 'name' => 'Income Types', 'route' => 'income_types.index', 'type' => 2 ],
            ['id'  => 2603, 'module_id' => 25, 'parent_id' => 2602, 'name' => 'Add', 'route' => 'income_types.store', 'type' => 3 ],
            ['id'  => 2604, 'module_id' => 25, 'parent_id' => 2602, 'name' => 'Edit', 'route' => 'income_types.edit', 'type' => 3 ],
            ['id'  => 2605, 'module_id' => 25, 'parent_id' => 2602, 'name' => 'Delete', 'route' => 'income_types.destroy', 'type' => 3 ],

            //Expense Type
            ['id'  => 2606, 'module_id' => 25, 'parent_id' => 2601, 'name' => 'Expense Types', 'route' => 'expense_types.index', 'type' => 2 ],
            ['id'  => 2607, 'module_id' => 25, 'parent_id' => 2606, 'name' => 'Add', 'route' => 'expense_types.store', 'type' => 3 ],
            ['id'  => 2608, 'module_id' => 25, 'parent_id' => 2606, 'name' => 'Edit', 'route' => 'expense_types.edit', 'type' => 3 ],
            ['id'  => 2609, 'module_id' => 25, 'parent_id' => 2606, 'name' => 'Delete', 'route' => 'expense_types.destroy', 'type' => 3 ],

            //Bank Accounts
            ['id'  => 2610, 'module_id' => 25, 'parent_id' => 2601, 'name' => 'Bank Accounts', 'route' => 'bank_accounts.index', 'type' => 2 ],
            ['id'  => 2611, 'module_id' => 25, 'parent_id' => 2610, 'name' => 'Add', 'route' => 'bank_accounts.store', 'type' => 3 ],
            ['id'  => 2612, 'module_id' => 25, 'parent_id' => 2610, 'name' => 'Edit', 'route' => 'bank_accounts.edit', 'type' => 3 ],
            ['id'  => 2613, 'module_id' => 25, 'parent_id' => 2610, 'name' => 'Delete', 'route' => 'bank_accounts.destroy', 'type' => 3 ],

            //Taxes
            ['id'  => 2614, 'module_id' => 25, 'parent_id' => 2601, 'name' => 'Taxes', 'route' => 'taxes.index', 'type' => 2 ],
            ['id'  => 2615, 'module_id' => 25, 'parent_id' => 2614, 'name' => 'Add', 'route' => 'taxes.store', 'type' => 3 ],
            ['id'  => 2616, 'module_id' => 25, 'parent_id' => 2614, 'name' => 'Edit', 'route' => 'taxes.edit', 'type' => 3 ],
            ['id'  => 2617, 'module_id' => 25, 'parent_id' => 2614, 'name' => 'Delete', 'route' => 'taxes.destroy', 'type' => 3 ],

            //Incomes
            ['id'  => 2618, 'module_id' => 25, 'parent_id' => 2601, 'name' => 'Incomes', 'route' => 'incomes.index', 'type' => 2 ],
            ['id'  => 2619, 'module_id' => 25, 'parent_id' => 2618, 'name' => 'Add', 'route' => 'incomes.store', 'type' => 3 ],
            ['id'  => 2620, 'module_id' => 25, 'parent_id' => 2618, 'name' => 'Edit', 'route' => 'incomes.edit', 'type' => 3 ],
            ['id'  => 2621, 'module_id' => 25, 'parent_id' => 2618, 'name' => 'Delete', 'route' => 'incomes.destroy', 'type' => 3 ],

            //Expenses
            ['id'  => 2622, 'module_id' => 25, 'parent_id' => 2601, 'name' => 'Expenses', 'route' => 'expenses.index', 'type' => 2 ],
            ['id'  => 2623, 'module_id' => 25, 'parent_id' => 2622, 'name' => 'Add', 'route' => 'expenses.store', 'type' => 3 ],
            ['id'  => 2624, 'module_id' => 25, 'parent_id' => 2622, 'name' => 'Edit', 'route' => 'expenses.edit', 'type' => 3 ],
            ['id'  => 2625, 'module_id' => 25, 'parent_id' => 2622, 'name' => 'Delete', 'route' => 'expenses.destroy', 'type' => 3 ],

            ['id'  => 2626, 'module_id' => 25, 'parent_id' => 2601, 'name' => 'Profit', 'route' => 'report.profit', 'type' => 2 ],
            ['id'  => 2627, 'module_id' => 25, 'parent_id' => 2601, 'name' => 'Transactions', 'route' => 'report.transaction', 'type' => 2 ],
            ['id'  => 2628, 'module_id' => 25, 'parent_id' => 2601, 'name' => 'Statements', 'route' => 'report.statement', 'type' => 2 ],


            // Finance

            ['id'  => 2701, 'module_id' => 27, 'parent_id' => null, 'name' => 'Invoices', 'route' => 'invoice.index', 'type' => 1 ],

            //Income Invoices
            ['id'  => 2702, 'module_id' => 27, 'parent_id' => 2701, 'name' => 'Income Invoices', 'route' => 'invoice.incomes.index', 'type' => 2 ],
            ['id'  => 2703, 'module_id' => 27, 'parent_id' => 2702, 'name' => 'Show', 'route' => 'invoice.incomes.show', 'type' => 3 ],
            ['id'  => 2704, 'module_id' => 27, 'parent_id' => 2702, 'name' => 'Add', 'route' => 'invoice.incomes.store', 'type' => 3 ],
            ['id'  => 2705, 'module_id' => 27, 'parent_id' => 2702, 'name' => 'Edit', 'route' => 'invoice.incomes.edit', 'type' => 3 ],
            ['id'  => 2706, 'module_id' => 27, 'parent_id' => 2702, 'name' => 'Delete', 'route' => 'invoice.incomes.destroy', 'type' => 3 ],

            //Expense Invoices
            ['id'  => 2707, 'module_id' => 27, 'parent_id' => 2701, 'name' => 'Expense Invoices', 'route' => 'invoice.expenses.index', 'type' => 2 ],
            ['id'  => 2708, 'module_id' => 27, 'parent_id' => 2707, 'name' => 'Show', 'route' => 'invoice.expenses.show', 'type' => 3 ],
            ['id'  => 2709, 'module_id' => 27, 'parent_id' => 2707, 'name' => 'Add', 'route' => 'invoice.expenses.store', 'type' => 3 ],
            ['id'  => 2710, 'module_id' => 27, 'parent_id' => 2707, 'name' => 'Edit', 'route' => 'invoice.expenses.edit', 'type' => 3 ],
            ['id'  => 2711, 'module_id' => 27, 'parent_id' => 2707, 'name' => 'Delete', 'route' => 'invoice.expenses.destroy', 'type' => 3 ],

            ['id'  => 2712, 'module_id' => 27, 'parent_id' => 2701, 'name' => 'Add Payment To Invoices', 'route' => 'invoice.payment.add', 'type' => 2 ],
            ['id'  => 2713, 'module_id' => 27, 'parent_id' => 2701, 'name' => 'Invoice Settings', 'route' => 'invoice.settings', 'type' => 2 ],


        ];

        DB::table('permissions')->insert($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
