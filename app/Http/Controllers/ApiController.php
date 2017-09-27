<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\Permission;

class ApiController extends Controller{
	public function setRoleName($role_id,$role_name){
		//return response()->json(['result'=>'ok']);
		$role=Role::find($role_id);
		$role->name=$role_name;
		$role->save();
		return response()->json(['result'=>'ok']);
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
	
	public function test(Request $r){
		return response()->json($r);
	}
}
