<?php

namespace Tests\Feature;

use App\User;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JsonApiTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function an_unauthorized_user_cannot_store_a_github_token()
    {
        $token = $this->faker()->word;
        $this->putJson(route('token.put'), ['token' => $token])->assertUnauthorized();
    }

    /** @test */
    public function a_user_can_save_their_github_token_via_api_route()
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

    /** @test */
    public function an_authorized_user_cannot_delete_a_token()
    {
        $this->deleteJson(route('token.delete'))->assertUnauthorized();
    }

    /** @test */
    public function an_authorized_user_can_delete_their_token()
    {
        $token = $this->faker()->word;

        $user = factory(User::class)->create(['token' => $token]);

        $this->actingAs($user);

        $this->deleteJson(route('token.delete'))->assertSuccessful();

        $this->assertDatabaseHas('users', ['token' => null]);
    }

}
