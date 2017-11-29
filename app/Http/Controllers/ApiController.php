<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\Permission;
use App\User;
use App\Patient;
use Auth;
class ApiController extends Controller{

/*
	public function getStats(){
		$count=User::count();
		return response()->json(['users_count'=>$count]);
	}
*/
	public function setRoleName(Request $request){
		$success=true;
		$error=["code"=>0,"message"=>"NO_ERROR"];
		$role_id=$request->get('role_id');
		$role_new_name=$request->get('role_new_name');
		if($role_id && $role_new_name){
			if($role_id!=1){
				$role=Role::find($role_id);
				$role->name=$role_new_name;
				$role->save();
			}else{
				$success=false;
				$error['code']==2;
				$error['message']="can't change administrator role name";
			}
		}else{
			$success=false;
			$error['code']=1;
			$error['message']="role_id and role_new_name expected";
		}
		return redirect()->action('AdminController@roles_permissions_index');
		if($success){
			return response()->json(['result'=>'ok']);
		}else{
			
			return response()->json(['result'=>'failed',"error"=>$error]);
		}
	}    

	public function updateRoles(Request $r){
		$roles=$r->get('roles');
		$success=true;

		$errors=[
			'e0'=>'El nombre especificado para un rol esta vacio',
			'e1'=>'Rol no encontrado',
			'e2'=>'Permiso no encontrado',
		];
		$error='';


		/*Validar roles y permisos*/
		foreach($roles as $r){
			$role=Role::find($r['id']);
			
			if(!$role){
				$success=false;
				$error=$errors['e1'];
				break;
			}else{
				if(!empty($r['name'])&&strlen(trim($r['name']," "))==0){
					$success=false;
					$error=$errors['e0'];
					break;
				}else if(isset($r['permissions'])&&sizeof($r['permissions'])>0){
					foreach($r['permissions'] as $pid){
						$permission=Permission::find($pid);
						if(!$permission){
							$success=false;
							$error=$errors['e2'];
							break;
						}
					}
				}
			}
		}

		/*modificar roles*/
		if($success){
			foreach($roles as $r){
				$role=Role::find($r['id']);
				if($role->name!=$r['name']){
					$role->name=$r['name'];
					$role->save();
				}
				if(isset($r['permissions'])){
				$perms_names=array();
					foreach($r['permissions'] as $pid){
						array_push($perms_names,Permission::find($pid)->name);
					}
				$role->syncPermissions($perms_names);
				}else{
					$role->syncPermissions([]);
				}
			}
		}

		return response()->json([
			'success'=>$success,
			'error'=>$error,
		]);

	}
	
	public function test(){
		$query = http_build_query([
        'client_id' => 'client-id',
        'redirect_uri' => 'http://example.com/callback',
        'response_type' => 'code',
        'scope' => '',
    	]);
    	return $query;
	}

	public function show_token(){
		echo "<input type='text' value='{{csrf_token()}}'</input>";
		//return response()->json(['token'=>$token]);
	}

	public function get_doctors_list(){
    	$docs=collect();
    	foreach (User::orderBy('name','asc')->orderBy('lastname','asc')->get() as $user) {
    		if($user->hasRole('doctor')){
    			$docs->push(array(
    				'name'=>$user->name." ".$user->lastname,
    				'id'=>$user->id
    			));
    		}
    	}
    	return response()->json($docs);
	}

	public function get_assistaints_list(){
    	$docs=collect();
    	foreach (User::orderBy('name','asc')->orderBy('lastname','asc')->get() as $user) {
    		if($user->hasRole('asistente')){
    			$docs->push(array(
    				'name'=>$user->name." ".$user->lastname,
    				'id'=>$user->id
    			));
    		}
    	}
    	return response()->json($docs);
	}

	public function get_patients_list(){
    	$patients=collect();
    	foreach(Patient::all() as $p){
    		$patients->push(array(
    				'name'=>$p->name." ".$p->lastname,
    				'id'=>$p->id
    			));
    	}
    	return response()->json($patients);
	}

}
