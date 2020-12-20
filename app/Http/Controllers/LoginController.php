<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(): \Illuminate\Http\RedirectResponse
    {
        if (User::count() === 0) {
            $user = User::create([
                'name' => 'Shane Rosenthal',
                'email' => 'srosenthal82@gmail.com',
                'password' => Hash::make('password')
            ]);
        } else {
            $user = User::first();
        }

        auth()->login($user);


        return redirect()->back();
    }
}
