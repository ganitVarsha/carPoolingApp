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
                'email' => 'varsha.mittal@ganitsoftech.com',
                'password' => bcrypt('123456'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'first_name' => 'User2',
                'last_name' => 'Name',
                'email' => 'user2@gmail.com',
                'password' => bcrypt('secret'),
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }

}
