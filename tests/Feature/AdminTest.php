<?php

namespace Tests\Feature;

use App\Admin;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testOnlyLoggedInAdminsCanAccessAdminDashboard()
    {
        $response = $this->get(route('admin.dashboard'))
                        ->assertRedirect(route('admin.login'));
    }

    public function testUsersCantAccessAdminDashboard()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                        ->get(route('admin.dashboard'))
                        ->assertRedirect(route('admin.login'));
    }

    public function testAuthenticatedAdminsCanAccessAdminDashboard()
    {
        $admin = factory(Admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
                        ->get(route('admin.dashboard'))
                        ->assertOk();
    }
}
