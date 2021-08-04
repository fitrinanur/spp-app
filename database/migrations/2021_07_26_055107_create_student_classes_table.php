<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_classes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_class')->unsigned(); // foreign
            $table->bigInteger('nisn_student')->unsigned(); // foreign
            $table->timestamps();
        });
        Schema::table('student_classes', function(Blueprint $table) {
            $table->foreign('id_class')->references('id')->on('classes');
            $table->foreign('nisn_student')->references('nisn')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_classes');
    }
}
