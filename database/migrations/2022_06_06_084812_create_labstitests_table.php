<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabstitestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labstitests', function (Blueprint $table) {
            $table->id();
            $table->String('clinic code')->nullable();
            $table->bigInteger('CID')->nullable();
            $table->String('fuchiacode')->nullable();
            $table->tinyInteger('agey')->nullable();
            $table->tinyInteger('agem')->nullable();
            $table->String('Gender')->nullable();
            $table->String('Requested Doctor')->nullable();
            $table->String('Requested Doctor New')->nullable();
            $table->date('visit_date')->nullable();
            $table->String('Type Of Patient')->nullable();
            $table->String('Patient Type Sub')->nullable();
            $table->String('Wet Mount clue cell')->nullable();
            $table->String('Wet Mount Trichomonas')->nullable();
            $table->String('Wet Mount candida')->nullable();
            $table->String('wetoth')->nullable();
            $table->String('urethra WBC')->nullable();
            $table->String('Urethra diplococci intra-cell')->nullable();
            $table->String('Urethra diplococci extra-cell')->nullable();
            $table->String('Urethra Candida')->nullable();
            $table->String('uoth')->nullable();
            $table->String('Fornix Clue Cells')->nullable();
            $table->String('PMNL WBC')->nullable();
            $table->String('Fornix diplococci intra-cell')->nullable();
            $table->String('Fornix diplococci extra-cell')->nullable();
            $table->String('Fornix Candida')->nullable();
            $table->String('pfother')->nullable();
            $table->String('Endo cervix WBC')->nullable();
            $table->String('Endo cervix diplococci intra-cell')->nullable();
            $table->String('Endo cervix diplococci extra-cell')->nullable();
            $table->String('Endo cervix Candida')->nullable();
            $table->String('eother')->nullable();
            $table->String('Rectum WBC')->nullable();
            $table->String('Rectum diplococci intra-cell')->nullable();
            $table->String('Rectum diplococci extra-cell')->nullable();
            $table->String('rother')->nullable();
            $table->String('First Per Urine')->nullable();
            $table->String('Epithelial cells')->nullable();
            $table->String('PMNL cells')->nullable();
            $table->String('First Per Urine Diplococci Intra-Cell')->nullable();
            $table->String('First Per Urine Diplococci Extra-Cell')->nullable();
            $table->String('fpu_oth')->nullable();
            $table->String('Lab Techanician')->nullable();
            $table->date('idate')->nullable();
            $table->mediumInteger('visitID')->nullable();
            $table->tinyInteger('Clue cells result')->nullable();
            $table->String('PMNL result')->nullable();
            $table->tinyInteger('trichomonas result')->nullable();
            $table->tinyInteger('diplococci intra cell result')->nullable();
            $table->tinyInteger('diplococci extra cell result')->nullable();
            $table->tinyInteger('spermatozoites result')->nullable();
            $table->tinyInteger('candida result')->nullable();
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
        Schema::dropIfExists('labstitests');
    }
}
