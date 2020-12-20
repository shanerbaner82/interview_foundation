<?php

namespace App\Http\Controllers\Token;

use App\Http\Controllers\Controller;

class CheckForTokenController extends Controller
{
    public function __invoke()
    {
        return response()->json([
            'token' => auth()->user()->token
        ]);
    }
}
