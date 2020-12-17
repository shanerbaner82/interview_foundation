<?php

namespace App\Http\Services\Github;

class GithubService
{
    private $service;

    public function __construct(ApiService $service)
    {
        $this->service = $service;
    }

    public function starredRepositories(): string
    {
        return collect($this->service->getStarredRepositories())
            ->map(function ($repo) {
                return [
                    'id' => $repo['id'],
                    'owner' => $repo['owner'],
                    'name' => $repo['name'],
                    'url' => $repo['html_url'],
                    'watchers' => $repo['watchers']
                ];
            })->toJson();
    }
}
