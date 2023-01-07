<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InvalidCredentialException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        throw_unless(Auth::attempt($request->only(['email', 'password'])), InvalidCredentialException::class);
        // if (Auth::attempt($request->only(['email', 'password']))) {
        //     session()->regenerate();
        // }

        session()->regenerate();

        return redirect()->intended('login');
    }

    public function logout()
    {
        Auth::logout();

        session()->invalidate();
        session()->regenerate();

        return redirect()->intended('login');
    }
}
