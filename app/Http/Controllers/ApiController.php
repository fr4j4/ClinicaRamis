<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller{
	public function setRoleName($role_id,$role_name){
		return response()->json(['result'=>'ok']);
	}    
}
