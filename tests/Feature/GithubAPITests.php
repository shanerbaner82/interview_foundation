<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class GithubAPITests extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_save_their_github_token_via_api_route()
    {

    }
}
