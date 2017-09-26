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
		$admin=new User(array(
            'email'=>'admin@localhost.com',
            'nickname'=>'admin',
            'name'=>'Administrador',
            'password'=>bcrypt('admin'),
        ));
        $admin->save();
        $admin->assignRole('administrador');


        $doc1=new User(array(
            'email'=>'alan.brito@localhost.com',
            'name'=>'Alan',
            'nickname'=>'alan',
            'lastname'=>'Brito',
            'password'=>bcrypt('abrito'),
        ));
        $doc1->save();
        $doc1->assignRole('doctor');

        $doc2=new User(array(
            'email'=>'aquiles.baeza@localhost.com',
            'name'=>'abaeza',
            'nickname'=>'aquiles',
            'lastname'=>'Baeza',
            'password'=>bcrypt('abaeza'),
        ));
        $doc2->save();
        $doc2->assignRole('doctor');
        $doc2->assignRole('administrador');

    }
}
