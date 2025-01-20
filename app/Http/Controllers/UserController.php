<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\Theme;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $profile_user = User::where('slug', $slug)->first();

        if (!$profile_user) {
            return redirect()->route('home');
        }

        if ((Auth::user()->id ?? null) != $profile_user->id) {

            $last_view = View::where(function ($query) use ($profile_user) {
                $query->where('user_id', $profile_user->id);
                $query->where('date', date('Y-m-d'));
                $query->where('ip', request()->ip());
            })->first();

            if (!$last_view) {
                View::create([
                    'user_id' => $profile_user->id,
                    'date' => date('Y-m-d'),
                    'ip' => request()->ip(),
                ]);
            }
        }

        $user = User::where('slug', $slug)->first();
        if (!$user) {
            abort(404);
        }
        $links = $user->links()->orderBy('order', 'asc')->where('active', true)->get();

        return view('profile.show', compact('user', 'links'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (!$user || $user->id != Auth::user()->id) {
            abort(403);
        }
        $themes = Theme::get();
        return view('profile.edit', compact('user', 'themes'));
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->except('_token');
        $user = User::find($user->id);

        if ($request->password || $request->confirm_password) {

            $user->update([
                'password' => bcrypt($data['password']),
            ]);
        }

        if ($request->file('image')) {
            try {
                Storage::disk('public')->delete($user->image);
            } catch (\Throwable $th) {
            }
            $user->update([
                'image' => $request->file('image')->store('images', 'public'),
            ]);
        }

        $user->update([
            'name' => $data['name'],
            'theme_id' => $data['theme_id'],
        ]);

        alert()->success('Perfil atualizado com sucesso!');

        return redirect()->route('users.edit', $user->id);
    }
}
