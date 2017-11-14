<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Auth;
class PagesController extends Controller{
    
    public function dashboard(){
    	$user=Auth::user();
    	$stats=[];
    	if($user){
    		if($user->can('ver_usuarios')){
    			$user_count=[
    				'title'=>'usuarios registrados',
    				'value'=>User::count()	,
    			];
    			array_push($stats,(object)$user_count);
    		}
    	}
    	//dd($stats);
    	return view('dashboard',compact('stats'));
    }
}
