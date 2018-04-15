<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncating existing records to start from scratch
        \App\User::truncate();


        // Creating 10 fake users
        $faker = \Faker\Factory::create();

        // Creating Hash for tha same Test password
        $password = Hash::make('secret');
        // Inserting 10 Fake Users
        for ($i = 0; $i < 10; $i++){
            \App\User::create([
                'name'=>$faker->name,
                'email'=>$faker->email,
                'password' => $password,
            ]);
        }
    }
}
