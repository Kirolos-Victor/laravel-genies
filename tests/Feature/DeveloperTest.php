<?php

namespace Tests\Feature;

use App\Models\Developer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DeveloperTest extends TestCase
{
    use RefreshDatabase;

    protected mixed $user;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = User::factory()->create();;
    }

    public function test_get_developers()
    {
        $this
            ->actingAs($this->user, 'sanctum')
            ->getJson('api/developers')
            ->assertStatus(200);
    }

    public function test_get_developer()
    {
        $developer = Developer::factory()->create();
        Sanctum::actingAs($this->user);
        $response = $this->get('/api/developers/' . $developer->id);
        $response->assertStatus(200);
    }

    public function test_store_developer()
    {
        Sanctum::actingAs($this->user);
        $formData = [
            'name' => 'test',
            'email' => 'test2@developer.com',
            'password' => '123456789',
            'password_confirmation' => '123456789',
            'username' => 'test'
        ];

        $response = $this->post('/api/developers', $formData);
        $response->assertStatus(200);
    }

    public function test_update_developer()
    {
        $developer = Developer::factory()->create();
        Sanctum::actingAs($this->user);
        $formData = [
            'name' => 'update',
            'email' => 'update@developer.com',
            'password' => '123456789',
            'password_confirmation' => '123456789',
            'username' => 'test'
        ];

        $response = $this->put('/api/developers/' . $developer->id, $formData);
        $response->assertStatus(200);
    }

    public function test_delete_developer()
    {
        $developer = Developer::factory()->create();
        Sanctum::actingAs($this->user);
        $response = $this->delete('/api/developers/' . $developer->id);
        $response->assertStatus(200);
    }
}
