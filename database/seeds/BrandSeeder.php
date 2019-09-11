<?php

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'brand' => 'Apple'
        ]);

        DB::table('brands')->insert([
            'brand' => 'Samsung'
        ]);

        DB::table('brands')->insert([
            'brand' => 'LG'
        ]);

        DB::table('brands')->insert([
            'brand' => 'Google'
        ]);

        DB::table('brands')->insert([
            'brand' => 'Microsoft'
        ]);
    }
}
