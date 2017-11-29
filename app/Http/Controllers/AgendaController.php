<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\MedApp;

class AgendaController extends Controller{
    
    public function show_doctor_agenda($did){
    	$doctor=User::find($did)->hasRole('doctor')?User::find($did):null;
    	$medApps=$doctor?$doctor->medical_appointments_as_doctor:null;
    	return view('agenda.doctor',compact('doctor','medApps'));
    }

    public function show_general_agenda(){
    	$medApps=MedApp::all();

    	return view('agenda.general',compact('medApps'));
    }
}
