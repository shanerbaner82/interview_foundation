<?php

namespace Tests\Feature;

use App\User;
use App\Http\Services\Github\GithubService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GithubAPITests extends TestCase
{

    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_save_their_github_token_via_api_route()
    {
        GithubService::shouldReceive('getStarredRepositories')->andReturn([
            'hello' => 'hi'
        ]);

        $token = $this->faker()->word;
        $user = factory(User::class)->create(['token' => $token]);

        $this->actingAs($user);

        $this->getJson('/api/stars')->assertJson([
            'hello' => 'hi'
        ]);

    }
}
