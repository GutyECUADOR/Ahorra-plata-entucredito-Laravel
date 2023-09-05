<?php

namespace App\Http\Controllers;

use App\Models\Analisis;
use App\Models\Credito;
use Illuminate\Http\Request;

class AnalisisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Credito $credito)
    {
        return view('analisis.index', compact('credito'));
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
     * @param  \App\Models\Analisis  $analisis
     * @return \Illuminate\Http\Response
     */
    public function show(Analisis $analisis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Analisis  $analisis
     * @return \Illuminate\Http\Response
     */
    public function edit(Analisis $analisis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Analisis  $analisis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Analisis $analisis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Analisis  $analisis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Analisis $analisis)
    {
        //
    }
}
