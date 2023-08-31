<?php

namespace App\Http\Controllers;

use App\Models\Inversion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InversionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inversiones = Inversion::orderBy('id','desc')->get();
        
        return view('dashboard', compact('inversiones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
     * @param  \App\Models\Inversion  $inversion
     * @return \Illuminate\Http\Response
     */
    public function show(Inversion $inversion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inversion  $inversion
     * @return \Illuminate\Http\Response
     */
    public function edit(Inversion $inversion)
    {
        return view('inversiones.edit', compact('inversion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inversion  $inversion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inversion $inversion)
    {
        $request->validate([
            'tasa' => 'required|max:190',
            'monto' => 'required|int',
            'estado' => 'required|max:190',
            'observacion' => 'required|max:190',
            'fecha_inversion' => 'required|date',
            'dias_inversion' => 'required|int',
        ]);

        $monto_recibir = (($request->monto * $request->tasa) / 100) * $request->dias_inversion + $request->monto;

        $fecha_inversion = new Carbon($request->fecha_inversion);
        $fecha_pago = $fecha_inversion->addDay($request->dias_inversion);

        $tipoInversion = Inversion::findOrFail($inversion->id);
        $tipoInversion->estado = $request->estado;
        $tipoInversion->fecha_inversion = $request->fecha_inversion;
        $tipoInversion->dias_inversion = $request->dias_inversion;
        $tipoInversion->monto = $request->monto;
        $tipoInversion->fecha_pago = $fecha_pago;
        $tipoInversion->monto_recibir = $monto_recibir;
        $tipoInversion->observacion = $request->observacion;
        $tipoInversion->save();
        return redirect()->route('dashboard')->with('status', 'Inversion '.$inversion->id.' actualizada con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inversion  $inversion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inversion $inversion)
    {
        //
    }
}
