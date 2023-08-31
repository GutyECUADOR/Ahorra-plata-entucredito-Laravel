<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DiasInversion;
use Illuminate\Http\Request;

class DiasInversionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diasInversion = DiasInversion::all();
        return response([
            'diasInversion'=> $diasInversion,
            'message' => 'Lista de dias obtenida'
        ], 200);
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
     * @param  \App\Models\DiasInversion  $DiasInversion
     * @return \Illuminate\Http\Response
     */
    public function show(DiasInversion $DiasInversion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiasInversion  $DiasInversion
     * @return \Illuminate\Http\Response
     */
    public function edit(DiasInversion $DiasInversion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DiasInversion  $DiasInversion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiasInversion $DiasInversion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiasInversion  $DiasInversion
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiasInversion $DiasInversion)
    {
        //
    }
}
