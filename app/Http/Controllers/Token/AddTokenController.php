<?php

namespace App\Http\Controllers\Token;

use App\Http\Controllers\Controller;

class AddTokenController extends Controller
{
    public function __invoke()
    {
        $items = request()->validate([
            'token' => 'required|string'
        ]);

       auth()->user()->update([
           'token' => $items['token']
       ]);

    }
}
