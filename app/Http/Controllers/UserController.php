<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        return view('register.index');
    }

    public function store(UserRequest $request)
    {
        $data = $request->except('_token');
        $new_user = User::create($data);
        if ($new_user) {
            Auth::login($new_user);
            alert()->success('Bem vindo a sua conta!');
            return redirect()->route('dashboard');
        }
        return redirect()->route('register');
    }

    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        if (!$user) {
            abort(404);
        }
        return view('profile.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (!$user || $user->id != Auth::user()->id) {
            abort(403);
        }
        return view('profile.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->except('_token');
        $user = User::find($user->id);

        if ($request->password || $request->confirm_password) {
            // $request->validate([
            //     'password' => 'required|confirmed',
            // ]);

            $user->update([
                'password' => bcrypt($data['password']),
            ]);
        }

        $user->update([
            'name' => $data['name'],
        ]);

        alert()->success('Perfil atualizado com sucesso!');

        return redirect()->route('users.edit', $user->id);
    }
}
