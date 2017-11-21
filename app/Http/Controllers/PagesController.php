<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Patient;

use Auth;
class PagesController extends Controller{
    
    public function dashboard(){
    	$user=Auth::user();
    	$stats=[];
    	if($user){
    		if($user->can('ver_usuarios')){
    			$user_count=[
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
    	//dd($stats);
    	return view('dashboard',compact('stats'));
    }

    public function self_profile(){
        $user=Auth::user();
        return view('common.profile',compact('user'));
    }
}
