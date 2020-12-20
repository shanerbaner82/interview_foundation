<?php

namespace App\Http\Controllers\Token;

use App\Http\Controllers\Controller;

class DeleteTokenController extends Controller
{
    public function __invoke()
    {
        auth()->user()->update([
            'token' => null
        ]);
    }

}
