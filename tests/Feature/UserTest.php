<?php

namespace Tests\Feature;

use App\Admin;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup function for each test
     */
    public function setUp() :void
    {
        parent::setUp();
    }

    /**
     * teardown function for each test
     */
    public function tearDown() :void
    {
        parent::tearDown();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testOnlyLoggedInUsersCanAccessUserDashboard()
    {
        $response = $this->get(route('home'))
                        ->assertRedirect(route('login'));
    }

    public function testAdminsCantAccessUserDashboard()
    {
        $admin = factory(Admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
                        ->get(route('home'))
                        ->assertRedirect(route('login'));
    }

    public function testAuthenticatedUsersCanAccessUserDashboard(Type $var = null)
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                        ->get(route('home'))
                        ->assertOk();
    }
}
