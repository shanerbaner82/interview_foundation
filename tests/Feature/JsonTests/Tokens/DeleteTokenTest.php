<?php

namespace Tests\Feature\JsonTests\Tokens;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteTokenTest extends TestCase
{
    use WithFaker, RefreshDatabase;
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
