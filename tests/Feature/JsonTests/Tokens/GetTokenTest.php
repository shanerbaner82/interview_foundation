<?php

namespace Tests\Feature\JsonTests\Tokens;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetTokenTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function an_unauthorized_user_cannot_retrieve_a_github_token()
    {
        $this->getJson(route('token.get'))->assertUnauthorized();
    }

    /** @test */
    public function an_authorized_user_receives_null_token_if_one_is_not_set()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->getJson(route('token.get'))->assertJson([
            'token' => null
        ]);

    }

    /** @test */
    public function an_authorized_user_receives_token_if_one_is_set()
    {
        $token = $this->faker()->word;

        $user = factory(User::class)->create(['token' => $token]);

        $this->actingAs($user);

        $this->getJson(route('token.get'))
            ->assertJson([
                'token' => $token
            ]);
    }
}
