<?php

use Illuminate\Database\Seeder;
use App\Patient;


class PatientsTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(){
        $faker = Faker\Factory::create();
        for($i=0;$i<100;$i++){
			$mill=(string)rand(5,23);
			$mil=(string)rand(0,999);
			$cent=(string)rand(0,999);
			$digit=(string)rand(0,7);
			if($digit=='0'){
				$digit='k';
			}
			while(strlen($mill)<2){
				$mill="0".$mill;
			}
			while(strlen($mil)<3){
				$mil="0".$mil;
			}
			while(strlen($cent)<3){
				$cent="0".$cent;
			}
			$rut= $mill.$mill.$cent.'-'.$digit;
        	$genre=rand(0,1);
            $u=new Patient(array(
        		'name'=>$faker->firstname(),
        		'lastname'=>$faker->lastname(),
        		'phone'=>$faker->e164PhoneNumber(),
        		'email'=>$faker->unique()->email(),
        		'birthday'=>$faker->dateTimeThisCentury->format('Y-m-d'),
                'gender'=>$genre==0?'hombre':'mujer',
        		'rut'=>$rut,
        	));
        	$u->save();
        }
    }
}
