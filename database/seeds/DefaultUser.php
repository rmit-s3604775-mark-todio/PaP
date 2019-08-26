<?php

use Illuminate\Database\Seeder;

class DefaultUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'User',
            'username' => 'TestUser',
            'email' => 'user@user.com',
            'address_line_1' => 'Test Lane',
            'state_province' => 'Test',
            'city' => 'Testing',
            'country' => 'Laravel',
            'post_code' => '1234',
            'password' => Hash::make('password'),
        ]);
    }
}
