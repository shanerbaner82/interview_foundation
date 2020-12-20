<?php

namespace App\Http\Services\Github;

use App\User;
use Github\Exception\RuntimeException;
use GrahamCampbell\GitHub\Facades\GitHub;

class ApiService
{
    public $github;

    public function __construct(User $user)
    {
        $this->github = GitHub::getFactory()->make([
            'method' => 'token',
            'token' => $user->token
        ]);
    }

    public function getStarredRepositories(): array
    {
        return $this->github->me()->starring()->all();
    }
}
