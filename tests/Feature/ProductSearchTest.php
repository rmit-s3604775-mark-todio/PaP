<?php

namespace Tests\Feature;

use App\ProductRequest;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class ProductSearchTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup function for each test
     */
    public function setUp() :void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->artisan('db:seed --class=BrandSeeder');
        $this->artisan('db:seed --class=ConditionSeeder');
    }

    /**
     * teardown function for each test
     */
    public function tearDown() :void
    {
        parent::tearDown();
    }

    /**
     * Create Product Search When Logged In Test
     */
    public function testCreateProductSearchWhenLoggedInTest()
    {
        $response = $this->actingAs($this->user)->post(route('product-search.store'), [
            'product_name' => 'Test',
            'brand' => '',
            'condition' => '',
            'max_price' => '',
            'min_price' => '',
        ]);

        $response->assertStatus(302); //302 = HTTP Redirect
        $this->assertCount(1, ProductRequest::all());
    }

    /**
     * Make sure the product name is required
     */
    public function testProductNameRequired()
    {
        $response = $this->actingAs($this->user)->post(route('product-search.store'), [
            'product_name' => '',
            'brand' => '',
            'condition' => '',
            'max_price' => '',
            'min_price' => '',
        ]);

        $response->assertSessionHasErrors('product_name');
    }

    /**
     * Test to make sure the min price can not be less then 0
     */
    public function testProductMinPriceNotLessThenZero()
    {
        $response = $this->actingAs($this->user)->post(route('product-search.store'), [
            'product_name' => 'Test',
            'brand' => '',
            'condition' => '',
            'max_price' => '',
            'min_price' => -1,
        ]);

        $response->assertSessionHasErrors('min_price');
    }

    /**
     * Test to make sure the min price cant be greater than the max price
     */
    public function testProductMinPriceLessThanMaxPrice()
    {
        $response = $this->actingAs($this->user)->post(route('product-search.store'), [
            'product_name' => 'Test',
            'brand' => '',
            'condition' => '',
            'max_price' => 0,
            'min_price' => 100,
        ]);

        $response->assertSessionHasErrors('max_price');
    }

    /**
     * Test to make sure the product search can just have a max price
     */
    public function testProductMaxPrice()
    {
        $response = $this->actingAs($this->user)->post(route('product-search.store'), [
            'product_name' => 'Test',
            'brand' => '',
            'condition' => '',
            'max_price' => 0,
            'min_price' => '',
        ]);
        
        $this->assertCount(1, ProductRequest::all());
        $response->assertSessionHasNoErrors('max_price');
    }

    /**
     * Test to make sure the product search can just have a min price
     */
    public function testProductMinPrice()
    {
        $response = $this->actingAs($this->user)->post(route('product-search.store'), [
            'product_name' => 'Test',
            'brand' => '',
            'condition' => '',
            'max_price' => '',
            'min_price' => 0,
        ]);
        
        $this->assertCount(1, ProductRequest::all());
        $response->assertSessionHasNoErrors('min_price');
    }

    /**
     * Test to make sure product searches can be deleted
     */
    public function testDeleteProductSearchTest()
    {
        $response = $this->actingAs($this->user)->post(route('product-search.store'), [
            'product_name' => 'Test',
            'brand' => '',
            'condition' => '',
            'max_price' => '',
            'min_price' => '',
        ]);

        //Make sure the book was successfully added before trying to remove it.
        $this->assertCount(1, ProductRequest::all());
        $ps = ProductRequest::first();

        $response = $this->delete(route('product-search.destroy', $ps->id));

        $this->assertCount(0, ProductRequest::all());
    }
}
