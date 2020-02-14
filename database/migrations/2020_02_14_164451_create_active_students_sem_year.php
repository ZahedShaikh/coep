<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiveStudentsSemYear extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_students_sem_year', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('id')->references('id')->on('registerusers')->onDelete('cascade');
            
            $table->enum('degree', ['diploma', 'UG', 'PG'])->nullable();
            $table->enum('studentsCurrentYear', ['FY', 'SY', 'TY', 'BE', 'YD'])->default('FY');
            
            $table->integer('studentsCurrentSemester')->default(0);
            
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
        Schema::dropIfExists('active_students_sem_year');
    }
}
