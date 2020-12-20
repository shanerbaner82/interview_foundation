<?php

namespace App\Http\Controllers\Stars;

use App\Http\Controllers\Controller;
use App\Http\Services\Github\ApiService;

class StarsController extends Controller
{
    public function __invoke()
    {
        try {
            $service = new ApiService(auth()->user());
            $repos = $service->getStarredRepositories();
            return response()->json([
                'repos' => $repos
            ]);
        } catch (\Exception $e) {
            abort(422, $e->getMessage());
        }
    }
}
