<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewUserFormRequest;
use App\Http\Requests\UpdateUserFormRequest;
use App\Http\Requests\NewRoleFormRequest;
use Illuminate\Http\Request;

use App\Role;
use App\Permission;

use Auth;
use App\User;
use App\PermCat;/*categorias de permisos*/
class AdminController extends Controller{
    

    /*Usuarios*/
    public function users_index(){
    	$users=User::all();
    	return view('admin.users.index',compact('users'));
    }

    public function new_user_form(){
    	return view('admin.users.new');
    }
    
    public function create_new_user(NewUserFormRequest $req){

        $u=new User(array(
            'name'=>$req->get('firstname'),
            'lastname'=>$req->get('lastname'),
            'password'=>bcrypt($req->get('password')),
            'nickname'=>$req->get('nickname'),
            'phone'=>$req->get('phone'),
            'email'=>$req->get('email'),
            'rut'=>$req->get('rut'),
        ));
        $u->save();
        return redirect()->route('admin_users_index');
    }

    public function update_user(UpdateUserFormRequest $req){ 
        
        $user=user::findOrFail($req->get('uid'));

        if($req->get('password')){
            $user->password=bcrypt($req->get('password'));
        }
        if($req->get('name')){
            $user->name=$req->get('name');
        }
        if($req->get('lastname')){
            $user->lastname=$req->get('lastname');
        }
        if($req->get('phone')){
            $user->phone=$req->get('phone');
        }
        if($req->get('alias')){
            $user->nickname=$req->get('alias');
        }

        $user->save();
        return redirect()->action('AdminController@show_user_details',compact('user'));
    }

    function edit_user_roles_form($id){
        $user=User::findOrFail($id);
        $roles=Role::all();
        return view('admin.users.roles',compact('user','roles'));
    }

    function edit_user_roles(Request $req){
        $user=User::find($req->get('user_id'));
        if($req->get('role')){
            $user->syncRoles($req->get('role'));
        }else{
            $user->syncRoles([]);
        }
        return redirect()->action('AdminController@show_user_details',$user->id);
    }

    public function edit_user_form($id){
        $user=User::findOrFail($id);
        return view('admin.users.edit',compact('user'));
    }

    public function show_user_details($uid){
        $user=User::find($uid);
        if($user){
            return view('admin.users.details',compact('user'));        
        }else{
            return redirect()->route('admin_users_index');
        }
    }

    public function delete_user($uid){
        /*Elimina al usuario si y solo si no es el usuario que está actualmente realizando la operacion*/
        if(Auth::user()->id!=$uid){
            $user= User::find($uid);
            $user->delete();
        }
        return redirect()->route('admin_users_index');
    }


/*Roles*/
    public function roles_permissions_index(){
        $roles=Role::all();
        $permissions=Permission::all();
        $categories=PermCat::all();
    	return view('admin.roles_permissions.index',compact('roles','permissions','categories'));
    }

    /*ROLES Y PERMISOS*/
    public function new_role_form(){
        $permissions=Permission::all();
        return view('admin.roles_permissions.new_role',compact('permissions'));
    }

    public function create_new_role(NewRoleFormRequest $req){
        $r=new Role(array(
            'name' => strtolower($req->get('name')),
        ));
        $r->save();
        return redirect()->route('roles_permissions_index');
    }

    public function delete_role($rid){
        $role=Role::find($rid);
        if($role && $role->name!="administrador"){
            $role->delete();
        }
        return redirect()->route('roles_permissions_index');
    }

    public function save_permissions(Request $req){
        //return $req->get('roles');
        foreach($req->get('roles') as $i){
            //todos los permisos asociados
            $permissions=isset($i['permissions'])>0?$i['permissions']:[];//si no tiene permisos, se usa un arreglo vacío
            $r=Role::findOrFail($i['id']);
            $permissionsNames=[];
            foreach ($permissions as $pi) {
                $p=Permission::findOrFail($pi);
                array_push($permissionsNames, $p->name);
            }
            $r->syncPermissions($permissionsNames);
        }
        return redirect()->route('roles_permissions_index');
    }
}