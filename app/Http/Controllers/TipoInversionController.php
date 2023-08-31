<?php

namespace App\Http\Controllers;

use App\Models\TipoInversion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoInversionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tipo_inversions = DB::table('tipo_inversions')->get();
        return view('tipos-inversion.index', compact('tipo_inversions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // Form in modal
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->all();
        $request->validate([
            'nombre' => 'required|max:190|unique:tipo_inversions',
            'tasa' => 'required|unique:tipo_inversions',
            'nivel_ranking' => 'required|int',
        ]);

        TipoInversion::create($data);
        return redirect()->route('tipos-inversion.index')->with('status', 'El tipo de inversion '.$request->nombre.' registrada con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $tipoInversion = TipoInversion::findOrFail($id);
        return view('tipos-inversion.edit', compact('tipoInversion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate([
            'nombre' => 'required|max:190',
            'tasa' => 'required',
            'nivel_ranking' => 'required|int',
        ]);

        $tipoInversion = TipoInversion::findOrFail($id);
        $tipoInversion->nombre = $request->nombre;
        $tipoInversion->tasa = $request->tasa;
        $tipoInversion->nivel_ranking = $request->nivel_ranking;
        $tipoInversion->save();
        return redirect()->route('tipos-inversion.index')->with('status', 'El tipo de inversion '.$request->nombre.' actualizada con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $tipoInversion = TipoInversion::findOrFail($id);
        $tipoInversion->delete();
        return redirect()->back()->with('status', 'El tipo de inversion '.$tipoInversion->nombre.' eliminada con éxito!');
    }
}
