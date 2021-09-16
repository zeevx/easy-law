<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDateFieldsToDateTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::unprepared('ALTER TABLE hearing_dates CHANGE date date TIMESTAMP NULL DEFAULT NULL');
        \Illuminate\Support\Facades\DB::unprepared('ALTER TABLE cases CHANGE receiving_date receiving_date TIMESTAMP NULL DEFAULT NULL');
        \Illuminate\Support\Facades\DB::unprepared('ALTER TABLE cases CHANGE filling_date filling_date TIMESTAMP NULL DEFAULT NULL');
        \Illuminate\Support\Facades\DB::unprepared('ALTER TABLE cases CHANGE hearing_date hearing_date TIMESTAMP NULL DEFAULT NULL');
        \Illuminate\Support\Facades\DB::unprepared('ALTER TABLE cases CHANGE judgement_date judgement_date TIMESTAMP NULL DEFAULT NULL');
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
