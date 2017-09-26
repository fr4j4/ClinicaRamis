<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;
class ApiController extends Controller{
	public function setRoleName($role_id,$role_name){
		//return response()->json(['result'=>'ok']);
		$role=Role::find($role_id);
		$role->name=$role_name;
		$role->save();
		return response()->json(['result'=>'ok']);
	}    

	public function setPermissionsToRole(){

	}
}
