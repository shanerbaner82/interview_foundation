<?php

namespace App\Http\Services\Github;

use GrahamCampbell\GitHub\Facades\GitHub;

class ApiService
{
    public $github;

    public function __construct()
    {
       $this->github = GitHub::getFactory()->make([
           'method' => 'token',
           'token' => auth()->user()->token
       ]);
    }

    public function getStarredRepositories(): array
    {
        return $this->github->me()->starring()->all();
    }
}
