<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsAdminTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNewsListAvailable()
    {
        $response = $this->get(route('admin.news.index'));

        $response->assertStatus(200);
    }

    public function testNewsCreateAvailable()
    {
        $response = $this->get(route('admin.news.index'));

        $response->assertStatus(200);
    }

   public function testNewsStoreJson()
    {
        $faker = Factory::create();
        $data = [
            'title' => "Hello World",
            'author' => $faker->userName(),
            'status' => 'DRAFT',
            'description' => $faker->text(100)
        ];
        $response = $this->post(route('admin.news.store'), $data);

        $response->assertStatus(201);
        $response->assertJson($data);
    }
    public function testCategoryListAvailable()
    {
        $response = $this->get(route('admin.categories.index'));

        $response->assertStatus(200);
    }
    public function testCategoryCreateAvailable()
    {
        $response = $this->get(route('admin.categories.index'));

        $response->assertStatus(200);
    }
    public function testUserListAvailable()
    {
    $response = $this->get(route('admin.categories.index'));

    $response->assertStatus(200);
    }
    public function testUserCreateAvailable()
    {
        $response = $this->get(route('admin.categories.index'));

        $response->assertStatus(200);
    }

}
