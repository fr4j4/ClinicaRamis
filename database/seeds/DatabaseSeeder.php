<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $this->call(RolesPermsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PatientsTableSeeder::class);
    }
}
