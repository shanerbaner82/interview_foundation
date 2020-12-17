<?php

namespace App\Http\Controllers;

use App\Http\Services\Github\GithubService;

class StarsController extends Controller
{
    /**
     * @var GithubService
     */
    private $service;

    /**
     * StarsController constructor.
     * @param GithubService $service
     */
    public function __construct(GithubService $service)
    {
        $this->service = $service;
    }

    public function __invoke(): string
    {
        try{
            return $this->service->starredRepositories(auth()->user()->token);
        }catch(\Exception $e){
            abort(422, $e->getMessage());
        }
    }
}
