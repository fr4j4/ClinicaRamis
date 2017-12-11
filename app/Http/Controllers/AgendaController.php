<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewMedAppRequest;

use Carbon\Carbon;

use App\User;
use App\MedApp;
use App\Patient;

class AgendaController extends Controller{
    
    public function show_doctor_agenda($did){
    	$doctor=User::find($did)->hasRole('doctor')?User::find($did):null;
    	return view('agenda.doctor',compact('doctor'));
    }

    public function show_general_agenda(){
    	return view('agenda.general');
    }

    public function newMedApp(NewMedAppRequest $req){
    	$medapp=new MedApp(array(
    		'start_time'=>Carbon::createFromFormat('Y-m-d H:i', $req->get('start_time')),
    		'end_time'=>Carbon::createFromFormat('Y-m-d H:i', $req->get('end_time')),
			'description'=>$req->get('description'),
			'treatment'=>$req->get('treatment'),
    	));

    	$patient=Patient::findOrFail($req->get('patient_id'));
    	$doc=User::findOrFail($req->get('doctor_id'));
    	$assist=$req->get('assistaint_id')?User::findOrFail($req->get('assistaint_id')):null;

    	$patient->medical_appointments()->save($medapp);
    	$doc->medical_appointments_as_doctor()->attach($medapp->id);
    	if($assist){
    		$assist->medical_appointments_as_assistant()->attach($medapp->id);	
    	}

    	return redirect()->action('AgendaController@show_general_agenda');
    }
}
