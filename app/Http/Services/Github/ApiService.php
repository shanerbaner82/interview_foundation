<?php

namespace App\Http\Services\Github;

use GrahamCampbell\GitHub\GitHubManager;

class ApiService
{
    /** @var GitHubManager */
    private $manager;

    public function __construct(GitHubManager $manager)
    {
        $this->manager = $manager;
    }

    public function getStarredRepositories(string $token): array
    {
        $client = $this->manager->getFactory()->make([
            'method'     => 'token',
            'token'      => $token,
        ]);

        return $client->me()->starring()->all();
    }
}
