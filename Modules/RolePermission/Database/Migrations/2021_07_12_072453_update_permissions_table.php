<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        change lawyer to opposite lawyer
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 340)->update(['name' => 'Opposite Lawyer']);

//       Court

        \Illuminate\Support\Facades\DB::table('permissions')->insert( [['id'  => 400, 'module_id' => 24, 'parent_id' => null, 'name' => 'Court', 'route' => 'court.index', 'type' => 1 ]]); //new head
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 309)->update(['module_id' => 24, 'parent_id' => 400, 'type' => 2]); //court
        \Illuminate\Support\Facades\DB::table('permissions')->whereIn('id', [310, 311, 312])->update(['module_id' => 24, 'type' => 3]); // court

        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 314)->update(['module_id' => 24, 'parent_id' => 400, 'type' => 2, 'name' => 'Court Category']); //category
        \Illuminate\Support\Facades\DB::table('permissions')->whereIn('id', [315, 316, 317])->update(['module_id' => 24]); //category

//        client
        \Illuminate\Support\Facades\DB::table('permissions')->insert( [['id'  => 401, 'module_id' => 14, 'parent_id' => null, 'name' => 'Client', 'route' => 'client.index', 'type' => 1 ]]);
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 330)->update(['module_id' => 14, 'parent_id' => 401, 'type' => 2]);
        \Illuminate\Support\Facades\DB::table('permissions')->whereIn('id', [332, 333, 334])->update(['module_id' => 14, 'type' => 3]);

        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 322)->update(['module_id' => 14, 'parent_id' => 401, 'type' => 2, 'name' => 'Client Category']);
        \Illuminate\Support\Facades\DB::table('permissions')->whereIn('id', [323, 324, 325])->update(['module_id' => 14]);

        //        contact
        \Illuminate\Support\Facades\DB::table('permissions')->insert( [['id'  => 402, 'module_id' => 21, 'parent_id' => null, 'name' => 'Contact', 'route' => 'contact', 'type' => 1 ]]);
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 369)->update(['module_id' => 21, 'parent_id' => 402, 'type' => 2]);
        \Illuminate\Support\Facades\DB::table('permissions')->whereIn('id', [371, 372, 373])->update(['module_id' => 21, 'type' => 3]);

        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 326)->update(['module_id' => 21, 'parent_id' => 402, 'type' => 2, 'name' => 'Contact Category']);
        \Illuminate\Support\Facades\DB::table('permissions')->whereIn('id', [327, 328, 329])->update(['module_id' => 21]);

       \Illuminate\Support\Facades\DB::table('permissions')->insert( [['id'  => 403, 'module_id' => 15, 'parent_id' => null, 'name' => 'Case', 'route' => 'case', 'type' => 1 ]]);
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 335)->update(['module_id' => 15, 'parent_id' => 403, 'type' => 2]);
        \Illuminate\Support\Facades\DB::table('permissions')->whereIn('id', [337, 338, 339, 368])->update(['module_id' => 15, 'type' => 3]);

        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 318)->update(['module_id' => 15, 'parent_id' => 403, 'type' => 2, 'name' => 'Case Category']);
        \Illuminate\Support\Facades\DB::table('permissions')->whereIn('id', [319, 320, 321])->update(['module_id' => 15]);

        \Illuminate\Support\Facades\DB::table('permissions')->whereIn('id', [345, 350, 355, 360])->update(['module_id' => 15, 'parent_id' => 403, 'type' => 2]);
        \Illuminate\Support\Facades\DB::table('permissions')->whereIn('id', [347, 348, 349,352, 353, 354, 357, 358, 359, 362, 363, 364, 365, 366, 367])->update(['module_id' => 15, 'type' => 3]);
        \Illuminate\Support\Facades\DB::table('permissions')->whereIn('id', [605, 348, 349,352, 353, 354, 357, 358, 359, 362, 363, 364, 365, 366, 367])->update(['module_id' => 15, 'type' => 3]);

        \Illuminate\Support\Facades\DB::table('permissions')->whereIn('id', [313, 199, 200, 201, 202])->delete();


        \Illuminate\Support\Facades\DB::table('permissions')->whereIn('id', [605])->update(['type' => 1, 'parent_id' => null]);

        $sql = [
            ['id'  => 800, 'module_id' => 11, 'parent_id' => 177, 'name' => 'Events', 'route' => 'events.index', 'type' => 2 ],
            ['id'  => 802, 'module_id' => 11, 'parent_id' => 800, 'name' => 'Edit', 'route' => 'events.edit', 'type' => 3 ],
            ['id'  => 803, 'module_id' => 11, 'parent_id' => 800, 'name' => 'Delete', 'route' => 'events.destroy', 'type' => 3 ],
            ['id'  => 804, 'module_id' => 11, 'parent_id' => 177, 'name' => 'Payroll Reports', 'route' => 'payroll_reports.index', 'type' => 2 ],

        ];

        \Illuminate\Support\Facades\DB::table('permissions')->insert($sql);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
