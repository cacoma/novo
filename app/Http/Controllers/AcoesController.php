<?php

namespace App\Http\Controllers;

use App\acoes;
use Illuminate\Http\Request;

class AcoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\acoes  $acoes
     * @return \Illuminate\Http\Response
     */
    public function show(acoes $acoes)
    {
        //
      $acoes = Acoes::find($id);
      return view('acoes.show', array('acoes' => $acoes));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\acoes  $acoes
     * @return \Illuminate\Http\Response
     */
    public function edit(acoes $acoes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\acoes  $acoes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, acoes $acoes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\acoes  $acoes
     * @return \Illuminate\Http\Response
     */
    public function destroy(acoes $acoes)
    {
        //
    }
}
