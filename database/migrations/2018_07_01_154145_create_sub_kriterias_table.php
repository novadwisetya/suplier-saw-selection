<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubKriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_kriterias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kriterias_id')->references('id')->on('kriterias');
            $table->string('sub_kriteria')->nullable();
            $table->float('nilai')->nullable();
            $table->string('kriteria_nilai')->nullable();
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
        Schema::drop('sub_kriterias');
    }
}
