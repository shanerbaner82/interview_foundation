<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeleteTokenController extends Controller
{
    public function __invoke()
    {
        auth()->user()->update([
            'token' => null
        ]);
    }

}
