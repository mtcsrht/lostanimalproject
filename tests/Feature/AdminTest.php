<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\User;

class AdminTest extends TestCase
{

    public function testIfUserCanUseAdminPanel(): void
    {
        $faker = \Faker\Factory::create();
        $email = $faker->email;
        Admin::create(['email' => $email]);
        $user = User::factory()->create(['email' => $email]);
        $this->actingAs($user);
        $response = $this->get('/admin');

        $response->assertStatus(200);
    }

    public function testIfUserCanNotUseAdminPanel(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/admin');

        $response->assertStatus(403);
    }
}
