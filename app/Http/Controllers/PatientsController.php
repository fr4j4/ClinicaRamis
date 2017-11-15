<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\NewPatientRequest;
use App\Patient;

use Illuminate\Support\Facades\Storage;

class PatientsController extends Controller{
    public function index(){
    	$patients=Patient::OrderBy('lastname','asc')->orderBy('name','asc')->paginate(15);
    	return view('patients.index',compact('patients'));
    }

    public function show_details($id){
    	$patient=Patient::find($id);
        $url=Storage::disk('patient_pictures')->url($patient->picture);
    	return view('patients.details',compact('patient','url'));
    }

    public function new_patient_form(){
    	return view('patients.new');
    }

    public function register_new_patient(NewPatientRequest $req){
        
        $patient=new Patient(array(
            'name'=>$req->get('firstname'),
            'lastname'=>$req->get('lastname'),
            'address'=>$req->get('address'),
            'gender'=>$req->get('gender'),
            'birthday'=>Carbon::createFromFormat('d/m/Y', $req->get('birthday')),
            'email'=>$req->get('email'),
            'rut'=>str_replace('.','',$req->get('rut')),
            'phone'=>$req->get('phone'),
        ));
        $patient->save();
        return redirect()->action('PatientsController@index');
    }

    public function patients_search(Request $req){
        $data=$req->get('data');
        $patients=Patient::Where('name','like',''.$data."%")->orWhere('lastname','like',''.$data."%")->orWhere('email','like','%'.$data.'%')->orWhere('phone','like','%'.$data.'%')->orderBy('lastname','asc')->orderBy('name','asc')->paginate(15);
        return view('patients.search',compact('patients','data'));
    }
}
