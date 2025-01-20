<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SocialController extends Controller
{
    public function __construct()
    {
        if (Auth::user()->is_admin != 1) {
            alert()->warning('Acesso negado');
            redirect()->route('dashboard')->send();
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socials = Social::get();
        return view('socials.index', compact('socials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('socials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        try {
            $data['user_id'] = Auth::user()->id;
            $data['image'] = $request->file('image')->store('socials', 'public');
            Social::create($data);
            alert()->success('Registro criado com sucesso!');
        } catch (\Throwable $th) {
            if (app()->environment('production')) {
                alert()->error('Erro ao criar registro!');
            } else {
                throw $th;
            }
        }
        return redirect()->route('socials.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Social $social)
    {
        //
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Social $social)
    {
        $social = Social::find($social->id);
        return view('socials.edit', compact('social'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Social $social)
    {
        $data = $request->except('_token');

        try {
            $social->update($data);
            if ($request->file('image')) {
                Storage::disk('public')->delete($social->image);
                $social->update([
                    'image' => $request->file('image')->store('socials', 'public'),
                ]);
            }
        } catch (\Throwable $th) {
            alert()->error('Erro ao atualizar o registro!');
        }

        alert()->success('Registro atualizado com sucesso!');
        return redirect()->route('socials.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Social $social)
    {
        try {
            $social->delete();
            alert()->success('Registro excluido com sucesso!');
        } catch (\Throwable $th) {
            alert()->error('Erro ao excluir o registro!');
        }
        return redirect()->route('socials.index');
    }
}
