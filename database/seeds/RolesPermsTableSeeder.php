<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\PermCat;
class RolesPermsTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
    */
    
    public function run(){
    	app()['cache']->forget('spatie.permission.cache');
        /*Permisos*/
        /*Administración plataforma*/
        Permission::create([
            'name' => 'create_users',
            'display_name' => 'registrar usuarios'
        ]);

        Permission::create([
            'name' => 'read_users',
            'display_name' => 'ver usuarios'
        ]);
        Permission::create([
        	'name' => 'update_users',
        	'display_name' => 'editar usuarios'
        ]);
        Permission::create([
        	'name' => 'delete_users',
        	'display_name' => 'eliminar usuarios'
        ]);



        /*Administración de pacientes*/
        Permission::create([
            'name' => 'create_patients',
            'display_name' => 'registrar pacientes'
        ]);
        Permission::create([
            'name' => 'read_patients',
            'display_name' => 'ver pacientes'
        ]);
        Permission::create([
            'name' => 'update_patients',
            'display_name' => 'editar pacientes'
        ]);
        Permission::create([
            'name' => 'delete_patients',
            'display_name' => 'eliminar pacientes'
        ]);

        
        /*Roles*/

        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'administrador',
        ]);

        $doc = Role::create([
            'name' => 'doctor',
            'display_name' => 'doctor',
        ]);

        $assis = Role::create([
            'name' => 'assistaint',
            'display_name' => 'asistente',
        ]);




        $admin->givePermissionTo('create_users');
        $admin->givePermissionTo('read_users');
        $admin->givePermissionTo('update_users');
        $admin->givePermissionTo('delete_users');

        $doc->givePermissionTo('create_patients');
        $doc->givePermissionTo('read_patients');
        $doc->givePermissionTo('update_patients');
        $doc->givePermissionTo('delete_patients');

        $assis->givePermissionTo('read_patients');
        $assis->givePermissionTo('read_users');


        /*Categorias de permisos*/
        $cat_system=new PermCat(array(
            'name'=>'system',
            'display_name'=>'sistema',
        ));
        $cat_system->save();

        $cat_patients=new PermCat(array(
            'name'=>'patients',
            'display_name'=>'pacientes',
        ));
        $cat_patients->save();

        /*Asignar categorias a los permisos*/
        //$cat_system->permissions()->save(Permission::where('name','=','create_users')->first());
        $cat_system->permissions()->save(Permission::where('name','=','read_users')->first());
        $cat_system->permissions()->save(Permission::where('name','=','update_users')->first());
        $cat_system->permissions()->save(Permission::where('name','=','delete_users')->first());

        $cat_patients->permissions()->save(Permission::where('name','=','create_patients')->first());
        $cat_patients->permissions()->save(Permission::where('name','=','read_patients')->first());
        $cat_patients->permissions()->save(Permission::where('name','=','update_patients')->first());
        $cat_patients->permissions()->save(Permission::where('name','=','delete_patients')->first());

    }
}
