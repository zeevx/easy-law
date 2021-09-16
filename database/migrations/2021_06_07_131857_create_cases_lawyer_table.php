<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCasesLawyerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases_lawyer', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cases_id')->nullable()->unsigned();
            $table->foreign('cases_id')->references('id')
                ->on('cases')->onDelete('cascade');

            $table->bigInteger('lawyer_id')->nullable()->unsigned();
            $table->foreign('lawyer_id')->references('id')
                ->on('lawyers')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });

        $cases = \App\Models\Cases::all();
        foreach($cases as $case){
            if ($case->lawyer_id){
                DB::table('cases_lawyer')
                    ->insert([
                        'cases_id' => $case->id,
                        'lawyer_id' => $case->lawyer_id,
                        'created_at' => Carbon::now(),
                    ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cases_lawyer');
    }
}
