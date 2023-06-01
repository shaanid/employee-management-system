<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\user;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }


    public function login(LoginRequest $request)
    {
        $input = $request->all();
        if (auth()->attempt([
            'email' => $input['email'],
            'password' => $input['password']
        ])) {
            if (auth()->user()->role == 1) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('profile');
            }
        } else {
            return redirect()->route('showLogin')
                ->with('error', 'Invalid email or password');
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect()
            ->route('showLogin');
    }
}
