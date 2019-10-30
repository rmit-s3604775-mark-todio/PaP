<?php

use Illuminate\Database\Seeder;
use App\Admin;

class FakeAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Admin::class, 20)->create();
    }
}
