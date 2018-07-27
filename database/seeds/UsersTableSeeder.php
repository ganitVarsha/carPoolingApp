<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            [
                'first_name' => 'Varsha',
                'last_name' => 'Mittal',
                'gender' => 'female',
                'dob' => '1990-01-24',
                'email' => 'varsha.mittal@ganitsoftech.com',
                'password' => bcrypt('123456'),
                'isd' => '+91',
                'phone' => '1234567890',
                'profession' => 'business',
                'nature' => 'intro',
                'created_at' => date('Y-m-d H:i:s'),
                'isAdmin' => '1',
            ],
            [
                'first_name' => 'User2',
                'last_name' => 'Name',
                'gender' => 'male',
                'dob' => '1990-01-23',
                'email' => 'user2@gmail.com',
                'password' => bcrypt('secret'),
                'isd' => '+91',
                'phone' => '1324567890',
                'profession' => 'business',
                'nature' => 'extro',
                'created_at' => date('Y-m-d H:i:s'),
                'isAdmin' => '0',
            ]
        ]);
    }

}
