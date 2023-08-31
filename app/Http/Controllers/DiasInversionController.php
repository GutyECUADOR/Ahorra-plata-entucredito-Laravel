<?php

namespace App\Http\Controllers;

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
        return view('dias-inversion.index', compact('diasInversion'));
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
        $data = $request->all();
        $request->validate([
            'nombre' => 'required|max:190|unique:dias_inversions',
            'dias' => 'required|int'
        ]);

        DiasInversion::create($data);
        return redirect()->route('dias-inversion.index')->with('status', 'El tipo de inversion '.$request->nombre.' registrada con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DiasInversion  $diaInversion
     * @return \Illuminate\Http\Response
     */
    public function show(DiasInversion $diasInversion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiasInversion  $diaInversion
     * @return \Illuminate\Http\Response
     */
    public function edit(DiasInversion $diasInversion)
    {
        return view('dias-inversion.edit', compact('diasInversion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DiaInversion  $diaInversion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiasInversion $diasInversion)
    {
        $request->validate([
            'nombre' => 'required|max:190',
            'dias' => 'required|int'
        ]);

        $diasInversion->nombre = $request->nombre;
        $diasInversion->dias = $request->dias;
     
        $diasInversion->save();
        return redirect()->route('dias-inversion.index')->with('status', 'El plazo de inversion: '.$request->nombre.' actualizada con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiaInversion  $diaInversion
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiasInversion $diasInversion)
    {
        $diasInversion->delete();
        return redirect()->back()->with('status', 'El plazo de inversion '.$diasInversion->nombre.' se ha eliminado con éxito!');
    }
}
