<?php

namespace App\Http\Controllers\Stars;


use App\Http\Controllers\Controller;
use App\Http\Services\Github\ApiService;

class StarsController extends Controller
{
    public function __invoke(): string
    {
        try{
            $service = new ApiService(auth()->user());
            return $service->getStarredRepositories();
        }catch(\Exception $e){
            abort(422, $e->getMessage());
        }
    }
}
