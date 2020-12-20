<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptedStorageTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_users_token_is_encrypted_in_the_database()
    {
        $token = $this->faker()->word;

        Crypt::shouldReceive('encryptString')->twice();

        factory(User::class)->create(['token' => $token]);

        $this->assertDatabaseHas('users', [
            'token' => Crypt::encryptString($token)
        ]);
    }

    /** @test */
    public function a_users_token_is_decrypted_when_retrieved_from_the_database()
    {
        $token = $this->faker()->word;

        Crypt::shouldReceive('encryptString');
        Crypt::shouldReceive('decryptString');

        $user = factory(User::class)->create(['token' => $token]);

        $this->assertTrue($user->token === Crypt::decryptString($token));
    }
}
