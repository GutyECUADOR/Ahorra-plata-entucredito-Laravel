<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function update_wallet_USDT(Request $request)
    {
        $request->validate([
            'wallet_usdt' => 'required'
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->wallet_usdt_tr20 = $request->wallet_usdt;
        $user->save();
        return redirect()->back()->with('status', 'Se registro tu wallet con éxito!');
    }

    public function update_wallet_ALARAB(Request $request)
    {
        $request->validate([
            'wallet_alarab' => 'required'
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->wallet_alarab = $request->wallet_alarab;
        $user->save();
        return redirect()->back()->with('status', 'Se registro tu wallet con éxito!');
    }
}
