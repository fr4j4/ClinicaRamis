<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Patient;
use App\MedApp;

use Auth;
//use Spatie\Activitylog\Models\Activity;
use App\Activity;
class PagesController extends Controller{
    
    public function dashboard(){
    	$user=Auth::user();
    	$stats=[];

    	if($user){
    		if($user->can('ver_usuarios')){
    			$user_count=[
                    'type'=>'count',
    				'title'=>'usuarios registrados',
    				'value'=>User::count(),
                    'icon'=>'fa-users',
                    'manage_button'=>[
                        'title'=>'ver usuarios registrados',
                        'url'=>route('admin_users_index'),
                    ],
    			];
    			array_push($stats,(object)$user_count);
    		}
    	}
        
        if($user->can('ver_pacientes')){
            $patients_count=[
                'type'=>'count',
                'title'=>'Pacientes registrados',
                'value'=>Patient::count(),
                'icon'=>'fa-address-card-o',
                'manage_button'=>[
                    'title'=>'ver pacientes registrados',
                    'url'=>route('patients_index'),
                ],
            ];
            array_push($stats,(object)$patients_count);
        }

        if($user->can('ver_agendas') || $user->can('registrar_horas') || $user->can('modificar_horas') || $user->can('eliminar_horas') ){

            $medapps_today=[
                'type'=>'count',
                'title'=>'Hora médicas para hoy',
                'value'=>MedApp::whereRaw('date(start_time) = CURDATE()')->whereRaw('ended = 0')->count(),
                'icon'=>'fa-calendar-check-o',
                'manage_button'=>[
                    'title'=>'ver agenda general',
                    'url'=>route('show_general_agenda'),
                ],
            ];
            array_push($stats,(object)$medapps_today);
        }

        if($user->can('ver_registros')){
            //traduccion a mano de las descripciones de actividades
            $activities=Activity::orderBy('id','desc')->take(10)->get();
            foreach ($activities as $a) {
                switch($a->description){
                    case "updated":
                        $a->description="actualizar";
                        break;
                    case "created":
                        $a->description="crear";
                        break;
                    case "deleted":
                        $a->description="eliminar";
                        break;
                    default:
                        break;
                }
            }

            $last_logs=[
                'type'=>'last_activity',
                'title'=>'Registros de actividad (últimos 10)',
                'value'=>$activities,
                'icon'=>'fa-pencil-square',
                'manage_button'=>[
                    'title'=>'ver registros de actividad',
                    'url'=>"#",
                ],
            ];
            array_push($stats,(object)$last_logs);
        }
    	
        return view('dashboard',compact('stats'));
    }

    public function self_profile(){
        $user=Auth::user();
        return view('common.profile',compact('user'));
    }
}
