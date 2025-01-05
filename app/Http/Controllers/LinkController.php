<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::get();
        return view('links.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $socials = Social::get();
        return view('links.create', compact('socials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        try {
            $data['user_id'] = Auth::user()->id;
            Link::create($data);
            alert()->success('Link criado com sucesso!');
        } catch (\Throwable $th) {
            alert()->error('Erro ao criar link!');
        }
        return redirect()->route('links.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        //
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        $link = Link::find($link->id);
        $socials = Social::get();
        return view('links.edit', compact('link', 'socials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Link $link)
    {
        $data = $request->except('_token');
        try {
            $link->update($data);
            alert()->success('Link atualizado com sucesso!');
        } catch (\Throwable $th) {
            alert()->error('Erro ao atualizar link!');
        }
        return redirect()->route('links.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        try {
            $link->delete();
            alert()->success('Link excluido com sucesso!');
        } catch (\Throwable $th) {
            alert()->error('Erro ao excluir link!');
        }
        return redirect()->route('links.index');
    }
}
