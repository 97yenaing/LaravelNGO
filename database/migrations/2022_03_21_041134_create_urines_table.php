<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urines', function (Blueprint $table) {
            $table->String("ClinicName")->nullable();
            $table->biginteger("CID")->nullable();
            $table->String("visitDate")->nullable();
            $table->String("fuchiacode")->nullable();
            $table->integer("agey")->nullable();
            $table->integer("agem")->nullable();
            $table->String("Gender")->nullable();

            $table->String("Utest_done")->nullable();
             $table->String("Utot")->nullable();
             $table->String("Ucolor")->nullable();
             $table->String("Uapp")->nullable();
             $table->String("Upus")->nullable();
             $table->String("ph")->nullable();
             $table->String("Uprotein")->nullable();
             $table->String("Uglucose")->nullable();
             $table->String("Urbc")->nullable();
             $table->String("Uleu")->nullable();
             $table->String("Unitrite")->nullable();
             $table->String("Uketone")->nullable();
             $table->String("Uepithelial")->nullable();
             $table->String("Urobili")->nullable();
             $table->String("Ubillru")->nullable();
             $table->String("Uery")->nullable();
             $table->String("Ucrystal")->nullable();
             $table->String("Uhae")->nullable();
             $table->String("Uother")->nullable();
             $table->String("Ucast")->nullable();
             $table->String("comment")->nullable();
             $table->String("lab_tech")->nullable();
             $table->String("issue_date")->nullable();

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
        Schema::dropIfExists('urines');
    }
}
