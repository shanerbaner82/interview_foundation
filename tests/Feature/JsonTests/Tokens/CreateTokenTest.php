<?php

namespace Tests\Feature\JsonTests\Tokens;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTokenTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function an_unauthorized_user_cannot_store_a_github_token()
    {
        $token = $this->faker()->word;
        $this->putJson(route('token.put'), ['token' => $token])->assertUnauthorized();
    }

    /** @test */
    public function a_user_can_store_their_github_token_via_api_route()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->assertDatabaseHas('users', [
            'token' => null
        ]);

        $token = $this->faker()->word;
        $this->actingAs($user);

        $this->putJson(route('token.put'), ['token' => $token])
            ->assertSuccessful();

        $lookupUser = User::first();

        $this->assertTrue($user->token === $lookupUser->token);

    }
}
