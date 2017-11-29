<?php
use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
class UsersTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        $virginia=new User(array(
            'email'=>'virginia.jaque@localhost.com',
            'nickname'=>'virginia',
            'name'=>'Virginia',
            'lastname'=>'Jaque',
            'password'=>bcrypt('virginia'),
        ));
        $virginia->save();

        $lizeth=new User(array(
            'email'=>'lizeth.astudillo@hotmail.com',
            'nickname'=>'lizeth',
            'name'=>'Lizeth',
            'lastname'=>'Astudillo',
            'password'=>bcrypt('lizeth'),
        ));
        $lizeth->save();


        $rramis=new User(array(
            'email'=>'rramis@localhost.com',
            'nickname'=>'rramis',
            'name'=>'Ruben',
            'lastname'=>'Ramis',
            'password'=>bcrypt('rramis'),
        ));
        $rramis->save();

		$admin=new User(array(
            'email'=>'admin@localhost.com',
            'nickname'=>'admin',
            'name'=>'Administrador',
            'password'=>bcrypt('admin'),
        ));
        $admin->save();
        $admin->assignRole('administrador');


        $rramis->assignRole('administrador');
        $rramis->assignRole('doctor');
        $virginia->assignRole('administrador');
        $lizeth->assignRole('asistente');
        $lizeth->assignRole('doctor');

    }
}
