<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*TABLA DE HORAS MEDICAS*/

class CreateMedicalAppointmentsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('medical_appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->string('treatment');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('description');
            $table->timestamps();
        });
        /*tabla intermedia de horas medicas y doctores*/
        Schema::create('meapps_doctors',function(Blueprint $table){
            $table->integer('medapp_id')->unsigned();
            $table->integer('doctor_id')->unsigned();
            $table->foreign('medapp_id')->references('id')->on('medical_appointments')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['medapp_id','doctor_id']);
        });


        /*tabla intermedia de horas medicas y asistentes*/

        Schema::create('meapps_assistants',function(Blueprint $table){
            $table->integer('medapp_id')->unsigned();
            $table->integer('assistaint_id')->unsigned();
            $table->timestamps();
            $table->foreign('medapp_id')->references('id')->on('medical_appointments')->onDelete('cascade');
            $table->foreign('assistaint_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['medapp_id','assistaint_id']); 
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('medical_appointments');
        Schema::dropIfExists('meapps_doctors');
        Schema::dropIfExists('meapps_assistants');
    }
}
