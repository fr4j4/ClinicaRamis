<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('patients',function(BLueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('rut');
            $table->date('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('patients');
    }
}
