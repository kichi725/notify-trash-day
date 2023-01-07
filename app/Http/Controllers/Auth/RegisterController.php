<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $inputs = $request->only(['email', 'password']);

        User::create([
            'email' => $inputs['email'],
            'password' => $inputs['password'],
        ]);
    }
}
