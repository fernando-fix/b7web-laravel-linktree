<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            alert()->success('Bem vindo a sua conta!');
            return redirect()->route('dashboard');
        }

        return back()->withInput()->withErrors([
            'modal_trigger' => '#modalLogin',
            'email' => 'E-mail e/ou senha incorretos',
        ]);
    }


    public function destroy($id)
    {
        $profile = Auth::user();
        Auth::logout();
        // if ($profile) {
        //     return redirect()->route('profile', $profile);
        // }
        return redirect()->route('home');
    }
}
