<?php

use Illuminate\Database\Seeder;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conditions')->insert([
            'condition' => 'New'
        ]);

        DB::table('conditions')->insert([
            'condition' => 'Like New'
        ]);

        DB::table('conditions')->insert([
            'condition' => 'Refurbished'
        ]);

        DB::table('conditions')->insert([
            'condition' => 'Broken'
        ]);
    }
}
