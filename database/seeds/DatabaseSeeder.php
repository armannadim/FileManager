<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Person;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PersonsTableSeeder::class);
    }
}

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        User::create(['name'=>'Nadim', 'email' => 'armannadim@msn.com', 'password'=> \Illuminate\Support\Facades\Hash::make('123456')]);
        User::create(['name'=>'Shamim', 'email' => 'saruaf@gmail.com', 'password'=> \Illuminate\Support\Facades\Hash::make('123456')]);
        User::create(['name'=>'Selim', 'email' => 'shekh28@yahoo.com', 'password'=> \Illuminate\Support\Facades\Hash::make('123456')]);
    }
}

class PersonsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('persons')->delete();

        Person::create(['name'=>'Nadim', 'image'=>'maa.jpg']);
        Person::create(['name'=>'Shamim', 'image'=>'maa.jpg']);
        Person::create(['name'=>'Selim', 'image'=>'maa.jpg']);

    }
}