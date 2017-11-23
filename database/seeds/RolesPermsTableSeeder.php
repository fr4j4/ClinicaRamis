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
            'name' => 'crear_usuarios',
            ////'display_name' => 'registrar usuarios'
        ]);

        Permission::create([
            'name' => 'ver_usuarios',
            //'display_name' => 'ver usuarios'
        ]);
        Permission::create([
        	'name' => 'modificar_usuarios',
        	//'display_name' => 'editar usuarios'
        ]);
        Permission::create([
            'name' => 'eliminar_usuarios',
            //'display_name' => 'eliminar usuarios'
        ]);



        /*Administración de pacientes*/
        Permission::create([
            'name' => 'crear_pacientes',
            //'display_name' => 'registrar pacientes'
        ]);
        Permission::create([
            'name' => 'ver_pacientes',
            //'display_name' => 'ver pacientes'
        ]);
        Permission::create([
            'name' => 'modificar_pacientes',
            //'display_name' => 'editar pacientes'
        ]);
        Permission::create([
            'name' => 'eliminar_pacientes',
            //'display_name' => 'eliminar pacientes'
        ]);


        //registros
        Permission::create([
            'name' => 'ver_registros',
            //'display_name' => 'eliminar usuarios'
        ]);
        
        /*Roles*/

        $admin = Role::create([
            'name' => 'administrador',
            //'display_name' => 'administrador',
        ]);

        $doc = Role::create([
            'name' => 'doctor',
            //'display_name' => 'doctor',
        ]);

        $assis = Role::create([
            'name' => 'asistente',
            //'display_name' => 'asistente',
        ]);


        $admin->givePermissionTo('crear_usuarios');
        $admin->givePermissionTo('ver_usuarios');
        $admin->givePermissionTo('modificar_usuarios');
        $admin->givePermissionTo('eliminar_usuarios');
        $admin->givePermissionTo('ver_registros');

        $doc->givePermissionTo('crear_pacientes');
        $doc->givePermissionTo('ver_pacientes');
        $doc->givePermissionTo('modificar_pacientes');
        $doc->givePermissionTo('eliminar_pacientes');

        $assis->givePermissionTo('ver_pacientes');
        $assis->givePermissionTo('ver_usuarios');


        /*Categorias de permisos*/
        $cat_system=new PermCat(array(
            'name'=>'sistema',
            //'display_name'=>'sistema',
        ));
        $cat_system->save();

        $cat_pacientes=new PermCat(array(
            'name'=>'pacientes',
            //'display_name'=>'pacientes',
        ));
        $cat_pacientes->save();

        /*Asignar categorias a los permisos*/
        $cat_system->permissions()->save(Permission::where('name','=','crear_usuarios')->first());
        $cat_system->permissions()->save(Permission::where('name','=','ver_usuarios')->first());
        $cat_system->permissions()->save(Permission::where('name','=','modificar_usuarios')->first());
        $cat_system->permissions()->save(Permission::where('name','=','eliminar_usuarios')->first());

        $cat_pacientes->permissions()->save(Permission::where('name','=','crear_pacientes')->first());
        $cat_pacientes->permissions()->save(Permission::where('name','=','ver_pacientes')->first());
        $cat_pacientes->permissions()->save(Permission::where('name','=','modificar_pacientes')->first());
        $cat_pacientes->permissions()->save(Permission::where('name','=','eliminar_pacientes')->first());

    }
}
