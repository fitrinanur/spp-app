<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('id_student_classes')->unsigned(); // foreign
            $table->bigInteger('id_grade_spp')->unsigned();// foreign
            $table->string('image_payment');
            $table->boolean('status')->default(1);
            $table->string('description');
            $table->date('date_payment');
            $table->integer('year_payment');
            $table->integer('month_payment');

            $table->timestamps();
        });
        Schema::table('payments', function(Blueprint $table) {
            $table->foreign('id_student_classes')->references('id')->on('student_classes');
            $table->foreign('id_grade_spp')->references('id')->on('grade_spps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
