<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabAfbTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_afb_tests', function (Blueprint $table) {
          $table->id();
          $table->integer('clinic code')->nullable();
          $table->biginteger('CID'                  ) -> nullable();
          $table->String('fuchiacode'           ) -> nullable();
          $table->String('agey'                 ) -> nullable();
          $table->String('agem'                 ) -> nullable();
          $table->String('Gender'               ) -> nullable();
          $table->String('Requested Doctor'     ) -> nullable();
          $table->date('visit_date'           ) -> nullable();
          $table->String('Patient Type'         ) -> nullable();
          $table->String('Patient Type Sub'     ) -> nullable();
          $table->String('Clinic'               ) -> nullable();
          $table->String('afb_pt_name'          ) -> nullable();
          $table->String('afb_pt_address'       ) -> nullable();
          $table->String('Previous_TB'          ) -> nullable();
          $table->String('HIV_status'           ) -> nullable();
          $table->String('reason_for_exam'      ) -> nullable();
          $table->String('afb_Pt_type'          ) -> nullable();
          $table->String('follow_up_mt'         ) -> nullable();
          $table->String('speci_type'           ) -> nullable();
          $table->String('oth_spe_ty')->nullable();
          $table->String('slide_num_1'          ) -> nullable();
          $table->String('speci_receive_dt1'    ) -> nullable();
          $table->String('visual_app_1'         ) -> nullable();
          $table->String('afb_result1'          ) -> nullable();
          $table->String('slide1_grading1'      ) -> nullable();
          $table->String('speci_receive_dt2'    ) -> nullable();
          $table->String('visual_app_2'         ) -> nullable();
          $table->String('afb_result2'          ) -> nullable();
          $table->String('slide2_grading2'      ) -> nullable();
          $table->String('afb_lab_techca'       ) -> nullable();
          $table->date('afb_issue_date'       ) -> nullable();
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
        Schema::dropIfExists('lab_afb_tests');
    }
}
