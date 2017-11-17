<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\NewPatientRequest;
use App\Http\Requests\UpdatePatientRequest;
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
            'gender'=>$req->get('gender')!='none'?$req->get('gender'):null,
            'birthday'=>$req->get('birthday')?Carbon::createFromFormat('d/m/Y', $req->get('birthday')):null,
            'email'=>$req->get('email'),
            'rut'=>str_replace('.','',$req->get('rut')),
            'phone'=>$req->get('phone'),
        ));
        
        if($req->hasFile('image')){
            //$path = $req->file('avatar')->store('avatars');
            //$path = Storage::putFile('avatars', $req->file('avatar'));
            if($patient->picture!='default.png'){//eliminar previa imagen si no es default
                Storage::disk('patient_pictures')->delete('/',$patient->picture);
            }
            $path =Storage::disk('patient_pictures')->putFile('/',$req->file('image'));

            $patient->picture=$path;
        }
        $patient->save();
        return redirect()->action('PatientsController@index');
    }

    public function patients_search(Request $req){
        $data=$req->get('data');
        $patients=Patient::Where('name','like',''.$data."%")->orWhere('lastname','like',''.$data."%")->orWhere('email','like','%'.$data.'%')->orWhere('phone','like','%'.$data.'%')->orderBy('lastname','asc')->orderBy('name','asc')->paginate(15);
        return view('patients.search',compact('patients','data'));
    }

    public function update_patient(UpdatePatientRequest $req){
        $patient=Patient::find($req->get('uid'));
        if($patient){
            if($req->get('name')){
                $patient->name=$req->get('name');
            }  
            
            if($req->get('lastname')){
                $patient->lastname=$req->get('lastname');
            }

            if($req->get('phone')){
                $patient->phone=$req->get('phone');
            }else{
                $patient->phone=null;
            }

            if($req->get('rut')){
                $patient->rut=$req->get('rut');
            }

            if($req->get('address')){
                $patient->address=$req->get('address');
            }else{
                $patient->address=null;
            }

            if($req->get('birthday')){
                $patient->birthday=Carbon::createFromFormat('d/m/Y', $req->get('birthday'));
            }

            if($req->get('gender')){
                $patient->gender=$req->get('gender')!='none'?$req->get('gender'):null;
            }else{
                $patient->gender=null;
            }

            if($req->get('email')){
                $patient->email=$req->get('email');
            }else{
                $patient->email=null;
            }
            
            if($req->hasFile('image')){
                //$path = $req->file('avatar')->store('avatars');
                //$path = Storage::putFile('avatars', $req->file('avatar'));
                if($patient->picture!='default.png'){//eliminar previa imagen si no es default
                    Storage::disk('patient_pictures')->delete('/',$patient->picture);
                }
                $path =Storage::disk('patient_pictures')->putFile('/',$req->file('image'));

                $patient->picture=$path;
            }

        
            $patient->save();
        }
        
        return redirect()->action('PatientsController@show_details',[$req->get('uid')]);
    }

    public function edit_patient_form($pid){
        $patient=Patient::find($pid);
        return view('patients.edit',compact('patient'));
    }


    public function delete_patient($pid){
        $p=Patient::find($pid);
        if($p){
            $p->delete();
        }
        return redirect()->action('PatientsController@index');
    }
}
