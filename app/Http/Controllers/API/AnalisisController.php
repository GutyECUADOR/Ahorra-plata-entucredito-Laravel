<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\InversionResource;
use App\Http\Resources\TipoInversionResource;
use App\Models\Analisis;
use App\Models\Credito;
use App\Models\FilaPrestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnalisisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $abonos = $request->get('abonos');
        $credito = $request->get('credito');

        FilaPrestamo::where('credito_id',$credito["id"])->delete();

        foreach ($abonos as $abono) {
            $validator = Validator::make($abono, [
                'mes' => 'required',
                'aextracapital' => 'required'
            ]);

            if ($validator->fails()) {
                return response([
                    'errors' => $validator->errors(),
                    'message' => 'Uno o más campos requeridos no pasaron la validación'
                ], 400);
            }

            $filaPrestamo = new FilaPrestamo();
            $filaPrestamo->mes = $abono["mes"];
            $filaPrestamo->aextracapital = $abono["aextracapital"];
            $filaPrestamo->credito_id = $credito["id"];
            $filaPrestamo->save();
        }

        return response([
            'abonos' => $abonos,
            'message' => 'Analisis Guardado!'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $credito = Credito::findOrFail($id);
        $abonos = FilaPrestamo::where('credito_id', $id)->get();
        return response([
            'credito'=>$credito,
            'abonos'=>$abonos,
            'message' => 'Tabla Obtenida'
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
