<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class JsonApiTests extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function an_unauthorized_user_cannot_store_a_github_token()
    {
        $token = $this->faker()->word;
        $this->putJson('/api/token', ['token' => $token])->assertUnauthorized();
    }

    /** @test */
    public function a_user_can_save_their_github_token_via_api_route()
    {
        Crypt::shouldReceive('encryptString');

        $user = factory(User::class)->create();

        $this->assertDatabaseHas('users', [
            'token' => null
        ]);

        $token = $this->faker()->word;
        $this->actingAs($user);

        $this->putJson('/api/token', ['token' => $token])
            ->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'token' => Crypt::encryptString($token)
        ]);
    }

    /** @test */
    public function an_unauthorized_user_cannot_retrieve_a_github_token()
    {
        $this->getJson('/api/token')->assertUnauthorized();
    }

    /** @test */
    public function an_authorized_user_receives_null_token_if_one_is_not_set()
    {
        Crypt::shouldReceive('encryptString');
        Crypt::shouldReceive('decryptString');

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->getJson('/api/token')->assertJson([
            'token' => null
        ]);

    }

    /** @test */
    public function an_authorized_user_receives_token_if_one_is_set()
    {
        $token = $this->faker()->word;

        $user = factory(User::class)->create(['token' => $token]);

        $this->actingAs($user);

        $this->getJson('/api/token')
            ->assertJson([
                'token' => $token
            ]);
    }

    /** @test */
    public function an_authorized_user_cannot_delete_a_token()
    {
        $this->deleteJson('/api/token')->assertUnauthorized();
    }

    /** @test */
    public function an_authorized_user_cane_delete_their_token()
    {
        $token = $this->faker()->word;

        $user = factory(User::class)->create(['token' => $token]);

        $this->actingAs($user);

        $this->deleteJson('/api/token')->assertSuccessful();

        $this->assertDatabaseHas('users', ['token' => null]);
    }


}
