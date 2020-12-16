<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckForTokenController extends Controller
{
    public function __invoke()
    {
        return response()->json([
            'token' => auth()->user()->token
        ]);
    }
}
