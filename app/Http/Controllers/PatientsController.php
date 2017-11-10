<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;

class PatientsController extends Controller{
    public function index(){
    	$patients=Patient::paginate(8);
    	return view('patients.index',compact('patients'));
    }

    public function show_details($id){
    	$patient=Patient::find($id);
    	return view('patients.details',compact('patient'));
    }

    public function new_patient_form(){
    	return view('patients.new');
    }
}
