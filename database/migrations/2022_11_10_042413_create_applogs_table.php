<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applogs', function (Blueprint $table) {
            $table->id();
            $table->String("User");
            $table->biginteger('Pid');
            $table->String("tableName");
            $table->String('Org_info');
            $table->String('Updated_info');
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
        Schema::dropIfExists('applogs');
    }
}
