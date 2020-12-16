<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
