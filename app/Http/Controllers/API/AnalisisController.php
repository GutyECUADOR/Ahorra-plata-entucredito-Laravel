<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\InversionResource;
use App\Http\Resources\TipoInversionResource;
use App\Models\Analisis;
use App\Models\Credito;

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
        $data = $request->all();
        $validator = Validator::make($data, [
            'nombre' => 'required|max:190|unique:tipo_inversions',
            'tasa' => 'required',
            'nivel_ranking' => 'required|int',
        ]);

        if ($validator->fails()) {
            return response([
                'errors' => $validator->errors(),
                'message' => 'Uno o más campos requeridos no pasaron la validación'
            ], 400);
        }

        $tipoInversion = TipoInversion::create($data);
        return response([
            'inversion' => new InversionResource($tipoInversion),
            'message' => 'Tipo de inversion registrada con éxito'
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
        /* $tablaAnalisis = [];


        $contador = 0;
        while ($credito->cuotas >= $contador) {
            $cuota = ($credito->interes * $credito->cantidad) ;


            $fila = new \stdClass();
            $fila->mes = $contador;
            $fila->cuota = $cuota;
            $fila->interes = $contador;
            $fila->acapital = $contador;
            $fila->capital = $contador;

            array_push($tablaAnalisis, $fila);
            $contador++;
        } */

        return response([
            'credito'=>$credito,
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
