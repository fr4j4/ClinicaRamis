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
            'display_name' => 'crear usuarios'
        ]);

        Permission::create([
            'name' => 'ver_usuarios',
            'display_name' => 'ver usuarios'
        ]);
        Permission::create([
        	'name' => 'modificar_usuarios',
        	'display_name' => 'modificar usuarios'
        ]);
        Permission::create([
            'name' => 'eliminar_usuarios',
            'display_name' => 'eliminar usuarios'
        ]);



        /*Administración de pacientes*/
        Permission::create([
            'name' => 'crear_pacientes',
            'display_name' => 'registrar pacientes'
        ]);
        Permission::create([
            'name' => 'ver_pacientes',
            'display_name' => 'ver pacientes'
        ]);
        Permission::create([
            'name' => 'modificar_pacientes',
            'display_name' => 'modificar pacientes'
        ]);
        Permission::create([
            'name' => 'eliminar_pacientes',
            'display_name' => 'eliminar pacientes'
        ]);


/*horas medicas y agenda*/

        Permission::create([
            'name' => 'ver_agendas',
            'display_name' => 'ver agenda de doctores',
        ]);

        Permission::create([
            'name' => 'registrar_horas',
            'display_name' => 'registrar hora médica',
        ]);

        Permission::create([
            'name' => 'modificar_horas',
            'display_name' => 'modificar hora médica',
        ]);

        Permission::create([
            'name' => 'eliminar_horas',
            'display_name' => 'eliminar hora médica',
        ]);









        //registros
        Permission::create([
            'name' => 'ver_registros',
            'display_name' => 'ver registro de acciones'
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
        $admin->givePermissionTo('ver_agendas');
        $admin->givePermissionTo('registrar_horas');
        $admin->givePermissionTo('modificar_horas');
        $admin->givePermissionTo('eliminar_horas');
        $admin->givePermissionTo('crear_pacientes');
        $admin->givePermissionTo('ver_pacientes');
        $admin->givePermissionTo('modificar_pacientes');
        $admin->givePermissionTo('eliminar_pacientes');


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

        $cat_horas_med=new PermCat(array(
            'name'=>'Agenda y horas medicas',
        ));
        $cat_horas_med->save();




        /*Asignar categorias a los permisos*/
        $cat_system->permissions()->save(Permission::where('name','=','crear_usuarios')->first());
        $cat_system->permissions()->save(Permission::where('name','=','ver_usuarios')->first());
        $cat_system->permissions()->save(Permission::where('name','=','modificar_usuarios')->first());
        $cat_system->permissions()->save(Permission::where('name','=','eliminar_usuarios')->first());

        $cat_pacientes->permissions()->save(Permission::where('name','=','crear_pacientes')->first());
        $cat_pacientes->permissions()->save(Permission::where('name','=','ver_pacientes')->first());
        $cat_pacientes->permissions()->save(Permission::where('name','=','modificar_pacientes')->first());
        $cat_pacientes->permissions()->save(Permission::where('name','=','eliminar_pacientes')->first());


        $cat_horas_med->permissions()->save(Permission::where('name','=','ver_agendas')->first());
        $cat_horas_med->permissions()->save(Permission::where('name','=','registrar_horas')->first());
        $cat_horas_med->permissions()->save(Permission::where('name','=','modificar_horas')->first());
        $cat_horas_med->permissions()->save(Permission::where('name','=','eliminar_horas')->first());



    }
}
