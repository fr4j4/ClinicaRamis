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
        $event_colors=[
            [
                'name'=>'Confirmada',
                'color'=>'#0000ff',
            ],
            [
                'name'=>'Sin confirmar',
                'color'=>'#f48c42',
            ],
            [
                'name'=>'Terminada',
                'color'=>'#00ff00',
            ],
        ];
    	return view('agenda.general',compact('event_colors'));
    }

    public function show_medapp_details($mid){
        $medapp=MedApp::find($mid);
        return view('agenda.medapp_details',compact('medapp'));
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

    public function medapp_update($mid){
        $medapp=MedApp::find($mid);
        return view('agenda.medapp_update',compact('medapp'));
    }

    public function medapp_confirm(Request $req){
        $medapp=MedApp::findOrFail($req->get('medapp_id'));
        if($medapp){
            $medapp->confirmed=true;
            $medapp->save();
            return "ok";
        }else{
            return "failed";
        }
    }

    public function medapp_end(Request $req){
        $medapp=MedApp::findOrFail($req->get('medapp_id'));
        if($medapp){
            $medapp->ended=true;
            $medapp->save();
            return "ok";
        }else{
            return "failed";
        }
    }

    public function medapp_cancel($mid){
        //return $mid;
        $medapp=MedApp::findOrFail($mid);
        if($medapp){
            $medapp->ended=true;
            $medapp->delete();
            return redirect()->action('AgendaController@show_general_agenda');
        }else{
            return "failed";
        }

    }
}
