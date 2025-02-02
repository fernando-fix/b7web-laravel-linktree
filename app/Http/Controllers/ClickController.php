<?php

namespace App\Http\Controllers;

use App\Models\Click;
use Illuminate\Http\Request;

class ClickController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $link_id)
    {
        $data = $request->except('_token');

        $data['link_id'] = $link_id;
        $data['date'] = date('Y-m-d');
        $data['ip'] = $request->ip;

        Click::create($data);

        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(Click $click)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Click $click)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Click $click)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Click $click)
    {
        //
    }
}
