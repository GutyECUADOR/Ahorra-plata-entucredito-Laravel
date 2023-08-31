<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'imagen_recibo' => 'required'
        ]);

        $filename = basename($request->file('imagen_recibo')->store('public/recibos'));
        
        $user = User::findOrFail(Auth::user()->id);
        $user->imagen_recibo = $filename;
        $user->save();

        return redirect()->back()->with('message', "Carga correcta del comprobante: " . $filename); 
    }
}
